<?php
include "autoload.php";
class Query extends Database {

    protected function __construct() {
        parent::__construct();
    }

    public function execState($query, $parameters) {
        try {

            $this->sqlMain = $this->connection->prepare($query);
            $this->bindMore($parameters);

            if(!empty($this->parameters)) {
                foreach($this->parameters as $params) {
                    //explode
                    $parameter = explode("\x7F", $params);
                    $this->sqlMain->bindParam($parameter[0], $parameter[1]);
                }
            }
            # Execute SQL
            $this->success = $this->sqlMain->execute();

        }catch(PDOException $e)
        {
            # Write into log and display Exception
            $this->ExceptionLog($e->getMessage(), $query);
        }
        # Reset the parameters
        $this->parameters = array();
    }

    //$db->bind("id","1");
    public function bind($param, $value) {
        $this->parameters[sizeof($this->parameters)] = ":".$param . "\x7F" . utf8_encode($value);
    }

    //$db->bindMore(array("firstname"=>"John","id"=>"1"));
    public function bindMore($array_params) {
        $col_keys = @array_keys($array_params);
        foreach ((array) $col_keys as $keys) {
            $this->bind($keys, $array_params[$keys]);
        }
    }
// ALTERNATIVE TO "bindMore"
//    public function bindMore($array_params) {
//        foreach ((array) $array_params as $key => $value) {
//            $this->bind($key, $value);
//        }
//    }

    // Build the working query
    public function query($query_type, $params = null, $fetchmode = PDO::FETCH_ASSOC) {

        $query_type = trim($query_type);

        $this->execState($query_type, $params);

        $rawStatement = explode(" ", $query_type);

        # Which SQL statement is used
        $statement = strtolower($rawStatement[0]);
        if($statement === 'select' || $statement === 'show') {
            return $this->sqlMain->fetchAll($fetchmode);
//            return $this->sqlMain;
        } else if($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->sqlMain->rowCount();
        } else {
            return null;
        }

    }

    public function row($query,$params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $this->execState($query,$params);
        return $this->sqlMain->rowCount();
    }


    private function ExceptionLog($message , $sql = "")
    {
        $exception  = 'Unhandled Exception. <br />';
        $exception .= $message;
        $exception .= "<br /> You can find the error back in the log.";

        if(!empty($sql)) {
            # Add the Raw SQL to the Log
            $message .= "\r\nRaw SQL : "  . $sql;
        }
        # Write into log
        throw new Exception($message);
        #return $exception;
    }
}