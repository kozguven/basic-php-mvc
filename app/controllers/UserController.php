<?php

class UserController extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $userModel = $this->model('UserModel');
            $userModel->register($username, $password);

            header('Location: /login');
        } else {
            $this->view('register');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = $this->model('UserModel');
            $user = $userModel->login($username, $password);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: /');
            } else {
                echo "Invalid credentials";
            }
        } else {
            $this->view('login');
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
    }

    public function profile($id)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $userModel = $this->model('UserModel');
        $user = $userModel->getUserById($id);

        $this->view('profile', ['user' => $user]);
    }
}