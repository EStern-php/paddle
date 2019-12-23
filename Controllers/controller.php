<?php
require_once('Models/model.php');

class Controller{
    
    public $model;
    public $controller;
    public $action;
    public $view;
    
    //kommer till index. Skapar en controller som tar url första är Vilken controller som ska kallas. Nästa är vilken function som ska kallas.
    
    public function __construct(){
       session_start();
        function loadModels($class) {
             $path = $_SERVER['DOCUMENT_ROOT'] . '/racer/Models/';
             require_once $path . $class .'.php';
        }
       spl_autoload_register('loadModels');
     /*   $url = $_SERVER['REQUEST_URI'];
        $url = array_filter(explode('/', $url));
        $this->controller = $url[2] ?? "Account";
        $this->action = $url[3] ?? "index";
        
        var_dump($url);
        var_dump($this->controller);
        $this->loadController($this->controller);
        $fa = new account();*/
      //  $fa->this->action();
      //  spl_autoload_register('loadView');
        
    }
    public function getController(){
       $url = $_SERVER['REQUEST_URI'];
        $url = array_filter(explode('/', $url));
        $this->controller = $url[2] ?? "Account";
        $this->action = $url[3] ?? "index";
        
        //var_dump($url);
     //   var_dump($this->action);
        $this->loadController($this->controller);
        new $this->controller($this->action);
        //$fa->index();
        //$action = $url[2] ?? "";
        
    }
    
    function loadController($class){
        try{
             $path = $_SERVER['DOCUMENT_ROOT'] . '/racer/Controllers/';
            if(!file_exists($path . $class .'.php')){
                throw new Exception("Couldn´t load controller");
            }else{
                require_once $path . $class .'.php';
            }
           
            
        }catch(Exception $e){
            echo "Message : " . $e->getMessage();
            echo "Code : " . $e->getCode();
        }
        
    }
    function loadView($class,$data = null){
       
        try{
           $path = $_SERVER['DOCUMENT_ROOT'] . '/racer/Views/';
            if(!file_exists($path . $class .'.php')){
                throw new Exception("Couldn´t load View");
            }else{
                 require_once $path . $class .'.php';
            }
        }catch(Exception $e){
            echo "Message : " . $e->getMessage();
            echo "Code : " . $e->getCode();
        }
        
        
    }
}


?>