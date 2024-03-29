<?php

class Database {
    private $_host = DB_HOST;
    private $_user = DB_USER;
    private $_pass = DB_PASS;
    private $_dbname   = DB_NAME;

    private $_dbh;
    private $_stmt;
    private $_error;

    public function __construct() {
        //set DSN
        $dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //create PDO instance
        try {
            $this->_dbh = new PDO($dsn, $this->_user, $this->_pass, $options);
        } catch(PDOException $e) {
            $this->_error = $e->getMessage();
            echo $this->_error;
        }
    }

    //prepare statement with query
    public function query($sql) {
        $this->_stmt = $this->_dbh->prepare($sql);
    }

    //bind values
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->_stmt->bindValue($param, $value, $type);
    }

    //execute the prepared statement
    public function execute() {
        return $this->_stmt->execute();
    }

    //get resultset as array of objects
    public function resultSet() {
        $this->execute();
        return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //get single record as object
    public function single() {
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_OBJ);
    }

    //get the row count
    public function rowCount() {
        return $this->_stmt->rowCount();
    }

}