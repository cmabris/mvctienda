<?php

class AdminUserController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminUser');
    }

    public function index()
    {
        $data = [
            'title' => 'Administración de usuarios',
            'menu' => false,
            'admin' => true,
            'data' => [],
        ];

        $this->view('admin/users/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Administración de usuarios - Alta',
            'menu' => false,
            'admin' => true,
            'data' => [],
        ];

        $this->view('admin/users/create', $data);
    }

    public function update()
    {
        echo 'Modificación de usuarios';
    }

    public function delete()
    {
        echo 'Eliminación de usuarios';
    }
}