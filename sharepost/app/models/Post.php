<?php

class Post {
    private $_db;

    public function __construct() {
        $this->_db = new Database();
    }

    public function getPosts() {
        $this->_db->query('SELECT *,
                            posts.id as postId,
                            users.id as userId,
                            posts.created_at as postCreated,
                            users.created_at as userCreated
                            FROM posts
                            INNER JOIN users
                            ON posts.user_id = users.id
                            ORDER BY posts.created_at DESC
                            ');

        $results = $this->_db->resultSet();

        return $results;
    }

    public function addPost($data) {
        //prepare query
        $this->_db->query("INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)");
        //bind values
        $this->_db->bind(':title', $data['title']);
        $this->_db->bind(':user_id', $data['user_id']);
        $this->_db->bind(':body', $data['body']);

        //execute query
        if($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($data) {
        //prepare query
        $this->_db->query("UPDATE posts SET title = :title, body = :body WHERE id = :id");
        //bind values
        $this->_db->bind(':id', $data['id']);
        $this->_db->bind(':title', $data['title']);
        $this->_db->bind(':body', $data['body']);

        //execute query
        if($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id) {
        //prepare query
        $this->_db->query("DELETE FROM posts WHERE id = :id");
        //bind values
        $this->_db->bind(':id', $id);

        //execute query
        if($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostById($id) {
        //prepare query
        $this->_db->query("SELECT * FROM posts WHERE id = :id");
        //bind values
        $this->_db->bind(':id', $id);

        //execute query
        $row = $this->_db->single();
            
        return $row;
    }
}