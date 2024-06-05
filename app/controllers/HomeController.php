<?php

class HomeController extends Controller
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $model = $this->model('HomeModel');
        $data = $model->getData();
        $this->view('home', $data);
    }
}