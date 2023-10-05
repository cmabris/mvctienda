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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = [];
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password1 = $_POST['password1'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            $dataForm = [
                'name' => $name,
                'email' => $email,
                'password' => $password1,
            ];

            if (empty($name)) {
                array_push($errors, 'El nombre es requerido');
            }
            if (empty($email)) {
                array_push($errors, 'El correo electrónico es requerido');
            }
            if (empty($password1)) {
                array_push($errors, 'La contraseña es requerida');
            }
            if (empty($password2)) {
                array_push($errors, 'Repetir la contraseña es requerida');
            }
            if ($password1 != $password2) {
                array_push($errors, 'Las contraseñas deben ser iguales');
            }

            if (count($errors) == 0) {

                //Si no hay errores, BD

            } else {

                $data = [
                    'title' => 'Administración de usuarios - Alta',
                    'menu' => false,
                    'admin' => true,
                    'errors' => $errors,
                    'data' => $dataForm,
                ];

                $this->view('admin/users/create', $data);
            }
        } else {

            $data = [
                'title' => 'Administración de usuarios - Alta',
                'menu' => false,
                'admin' => true,
                'data' => [],
            ];

            $this->view('admin/users/create', $data);

        }
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