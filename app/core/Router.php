<?php

class Router {
    protected $routes=[];


    public function get($uri,$controller)
    {
    $this->routes[]=[
        'uri'->$uri,
        'cotroller'->$controller,
        'method'->'GET'
    ];
    
    }
    public function post(){

    }
    public function delete(){

    }
}