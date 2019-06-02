<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        //get url
        $url = $this->getUrl();
        
        //look in controllers for first value
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            //if exists, set as controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        
        //require the controller class
        require_once '../app/controllers/' . $this->currentController . '.php';
        //Institiate the controller class
        $this->currentController = new $this->currentController;

        
        if(isset($url[1])) {
            //look in controllers for second value (method)
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        
        //get params
        $this->params = $url ? array_values($url) : [];
            
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }


}


  
  