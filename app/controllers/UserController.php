<?php

class UserController extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!CSRF::validateToken($_POST['csrf_token'])) {
                die("CSRF token validation failed");
            }

            $username = Validation::sanitize($_POST['username']);
            $password = Validation::sanitize($_POST['password']);

            if (!Validation::validateUsername($username)) {
                echo "Invalid username. It should be 3-20 characters long and can contain letters, numbers, and underscores.";
                return;
            }

            if (!Validation::validatePassword($password)) {
                echo "Invalid password. It should be at least 6 characters long.";
                return;
            }

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $userModel = $this->model('UserModel');
            $userModel->register($username, $passwordHash);

            header('Location: /login');
        } else {
            $this->view('register');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!CSRF::validateToken($_POST['csrf_token'])) {
                die("CSRF token validation failed");
            }

            $username = Validation::sanitize($_POST['username']);
            $password = Validation::sanitize($_POST['password']);

            $userModel = $this->model('UserModel');
            $user = $userModel->login($username, $password);

            if ($user && password_verify($password, $user->password)) {
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