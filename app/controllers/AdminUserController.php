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
        $session = new Session();

        $users = $this->model->getUsers();

        if ($session->getLogin()) {

            $data = [
                'title' => 'Administración de usuarios',
                'menu' => false,
                'admin' => true,
                'data' => $users,
            ];

            $this->view('admin/users/index', $data);

        } else {

            header('location:' . ROOT . 'admin');

        }

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

                if ($this->model->createAdminUser($dataForm)) {

                    header('location:' . ROOT . 'adminuser');

                } else {

                    $data = [
                        'title' => 'Error durante la creación del usuario',
                        'menu' => false,
                        'subtitle' => 'Error al crear un nuevo usuario administrador',
                        'text' => 'Sucedió un error durante la creación de un nuevo administrador',
                        'color' => 'alert-danger',
                        'url' => 'adminuser',
                        'colorButton' => 'btn-danger',
                        'textButton' => 'Volver',
                    ];

                    $this->view('mensaje', $data);

                }

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

    public function update($id)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password1 = $_POST['password1'] ?? '';
            $password2 = $_POST['password2'] ?? '';
            $status = $_POST['status'] ?? '';

            if (empty($name)) {
                array_push($errors, 'El nombre de usuario es requerido');
            }
            if (empty($email)) {
                array_push($errors, 'El email del usuario es requerido');
            }
            if ($status == '') {
                array_push($errors, 'Selecciona el estado del usuario');
            }
            if ( ! empty($password1) || ! empty($password2)) {
                if ($password1 != $password2) {
                    array_push($errors, 'Las contraseñas no coinciden');
                }
            }

            if (empty($errors)) {

                $data = [
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'password' => $password1,
                    'status' => $status,
                ];
                $errors = $this->model->setUser($data);

                if (empty($errors)) {
                    header('location:' . ROOT . 'adminuser');
                }
            }
        }

        $user = $this->model->getUserById($id);
        $status = $this->model->getConfig('adminStatus');

        $data = [
            'title' => 'Administración de usuarios - Modificación',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'status' => $status,
            'data' => $user,
        ];

        $this->view('admin/users/update', $data);

    }

    public function delete($id)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = $this->model->delete($id);

            if (empty($errors)) {
                header('location:' . ROOT . 'adminuser');
            }
        }

        $user = $this->model->getUserById($id);
        $status = $this->model->getConfig('adminStatus');
        $data = [
            'title' => 'Administración de usuarios - Eliminación',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'status' => $status,
            'data' => $user,
        ];

        $this->view('admin/users/delete', $data);
    }
}