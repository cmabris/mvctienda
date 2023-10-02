<?php

class LoginController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Login');
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'menu' => false,
        ];

        $this->view('login', $data);
    }

}