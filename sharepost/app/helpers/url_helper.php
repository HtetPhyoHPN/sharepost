<?php

//sample page redirector
function redirect($page = '') {
    header('Location: ' . URLROOT . '/' . $page);
}