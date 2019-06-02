<?php

session_start();

function flash($name = '', $message = '', $class = 'alert-success') {
    if(!empty($name)) {
        //use in Controller - to start session and give params to session
        //flash('success', 'You made it successfully');
        if(!empty($message) && empty($_SESSION[$name])) {

            if(!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if(!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;

        } elseif(empty($message) && !empty($_SESSION[$name])) {
            //use in view - to display the actual flash message
            //flash('success')
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';

            echo '
            <div class="alert ' . $class . ' alert-dismissible fade show alert-custom" id=msg-flash role="alert"">' . $_SESSION[$name] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';

            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

function isLoggedIn() {
    if(isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}