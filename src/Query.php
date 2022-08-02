<?php

require_once 'autoload.php';

class Query extends Database {

    protected function __construct() {
        parent::__construct();
    }

    /**
     *	@void
     *
     *	Add the parameter to the parameter array
     *	@param string $param
     *	@param string $value
     */
    //$db->bind("id","1");
    public function bind($param, $value) {
        $this->parameters[sizeof($this->parameters)] = ":".$param . "\x7F" . utf8_encode($value);
    }


    /**
     *	@void
     *
     *	Add more parameters to the parameter array
     *	@param array $parray
     */
    //$db->bindMore(array("firstname"=>"John","id"=>"1"));
//    public function bindMore($array_params) {
//        $col_keys = @array_keys($array_params);
//        foreach ((array) $col_keys as $keys) {
//            $this->bind($keys, $array_params[$keys]);
//        }
//    }
// ALTERNATIVE TO "bindMore"
    public function bindMore($array_params) {
        foreach ((array) $array_params as $key => $value) {
            $this->bind($key, $value);
        }
    }


    /**
     *	Every method which needs to execute a SQL query uses this method.
     *
     *	1. If not connected, connect to the database.
     *	2. Prepare Query.
     *	3. Parameterize Query.
     *	4. Execute Query.
     *	5. On exception : Write Exception into the log + SQL query.
     *	6. Reset the Parameters.
     */
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




    /**
     *  If the SQL query  contains a SELECT or SHOW statement it returns an array containing all of the result set row
     *	If the SQL statement is a DELETE, INSERT, or UPDATE statement it returns the number of affected rows
     *
     *  @param  string $query
     *	@param  array  $params
     *	@param  int    $fetchmode
     *	@return mixed
     */
    // Build the working query
    public function query($query, $params = null, $fetchmode = PDO::FETCH_ASSOC) {

        $query_type = trim($query);

        $this->execState($query, $params);

        $rawStatement = explode(" ", $query);

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


    /**
     *	Returns an array which represents a row from the result set
     *
     *	@param  string $query
     *	@param  array  $params
     *  @param  int    $fetchmode
     *	@return array
     */
    public function row($query,$params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $this->execState($query,$params);
        return $this->sqlMain->rowCount();
    }


    /**
     * Writes the log and returns the exception
     *
     * @param  string $message
     * @param  string $sql
     * @return string
     */
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