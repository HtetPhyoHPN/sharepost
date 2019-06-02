<?php

class User {

    private $_db;

    public function __construct() {
        $this->_db = new Database();
    }

    //register user
    public function register($data = []) {
        //prepare query
        $this->_db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");
        //bind values
        $this->_db->bind(':name', $data['name']);
        $this->_db->bind(':email', $data['email']);
        $this->_db->bind(':password', $data['password']);

        //execute query
        if($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //login user
    public function login($email, $password) {
        $this->_db->query('SELECT * FROM users WHERE email = :email');
        $this->_db->bind(':email', $email);

        $row = $this->_db->single();

        $hash_password = $row->password;
        if(password_verify($password, $hash_password)) {
            return $row;
        } else {
            return false;
        }
    }

    //find user by email
    public function findUserByEmail($email) {
        //prepare query
        $this->_db->query("SELECT * FROM users WHERE email = :email");
        //bind value
        $this->_db->bind(':email', $email);

        $row = $this->_db->single();

        //check row
        if($this->_db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

     //find user by id
     public function getUserById($id) {
        //prepare query
        $this->_db->query("SELECT * FROM users WHERE id = :id");
        //bind value
        $this->_db->bind(':id', $id);

        $row = $this->_db->single();

        return $row;
    }
}

