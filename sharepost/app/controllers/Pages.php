<?php

class Pages extends Controller {
    
    public function __construct() {
       
    }

    public function index() {

        if(isLoggedIn()) {
            redirect('posts');
        }

        $data = [
            'title' => 'S H A R E P O S T',
            'description' => 'Sample Social Network built on HardCodeMVC'
        ];
        
        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'About us',
            'description' => 'A place to share anything with anyone'
        ];

        $this->view('pages/about', $data);
    }
}