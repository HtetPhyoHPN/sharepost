<?php

class Users extends Controller {

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        //Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process form

            //sanitize the data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = Array(
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            );

            //validate empty case
            foreach($data as $keys => $value) {
                if(empty($value)) {
                    $data[$keys . '_err'] = 'Please enter your ' . $keys;
                }
            }

            //check email is already taken ?
            if($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'Email is already taken';
            }

            //check password empty and length
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 charactes long.';
            }

            //check passwords match
            if($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Passwords do not match';
            }

            //make sure errors are empty
            if(
            empty($data['name_err']) &&
            empty($data['email_err']) &&
            empty($data['password_err']) &&
            empty($data['confirm_password_err'])) {
                //validated

                //hash password : one-way hash
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //register user
                if($this->userModel->register($data)) {
                    flash('register_success', 'You have successfully registered and now can login.');
                    redirect('users/login');
                } else {
                    die('Something went wrong.');
                }
            } else {
                //load view with errors
                $this->view('users/register', $data);
            }

        } else {
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //load view
            $this->view('users/register', $data);
        }
    }

    public function login() {
        //Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process form

            //sanitize the data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //init data
            $data = Array(
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            );

            //check email is empty and  really exists in database ?
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            } elseif(!$this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'No member information';
            }

            //check if password field is empty
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter your password';
            }

            //make sure errors are empty
            if(
            empty($data['email_err']) &&
            empty($data['password_err'])) {
                //validated

                //Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser) {
                    //Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('users/login', $data);
                }
            } else {
                //load view with errors
                $this->view('users/login', $data);
            }

        } else {
            //init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            //load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();

        //redirect to http://localhost/sharepost/
        redirect();
    }
}