<?php

class Controller
{
    protected $blade;

    public function __construct()
    {
        $this->blade = require_once '../app/config/blade.php';
    }

    public function view($view, $data = [])
    {
        echo $this->blade->render($view, $data);
    }

    public function model($model)
    {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        } else {
            echo "Model $model not found";
        }
    }
}