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
        if (isset($_COOKIE['shoplogin'])) {
            $value = explode('|', $_COOKIE['shoplogin']);
            $dataForm = [
                'user' => $value[0],
                'password' => $value[1],
                'remember' => 'on'
            ];

        } else {
            $dataForm = null;
        }

        $data = [
            'title' => 'Login',
            'menu' => false,
            'data' => $dataForm,
        ];

        $this->view('login', $data);
    }

    public function registro()
    {
        $errors = [];
        $dataForm = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Validar datos del formulario
            $firstName = $_POST['first_name'] ?? '';
            $lastName1 = $_POST['last_name_1'] ?? '';
            $lastName2 = $_POST['last_name_2'] ?? '';
            $email = $_POST['email'] ?? '';
            $password1 = $_POST['password1'] ?? '';
            $password2 = $_POST['password2'] ?? '';
            $address = $_POST['address'] ?? '';
            $city = $_POST['city'] ?? '';
            $state = $_POST['state'] ?? '';
            $postcode = $_POST['postcode'] ?? '';
            $country = $_POST['country'] ?? '';

            $dataForm = [
                 'first_name' => $firstName,
                 'last_name_1' => $lastName1,
                 'last_name_2' => $lastName2,
                 'email' => $email,
                 'password1' => $password1,
                 'password2' => $password2,
                 'address' => $address,
                 'city' => $city,
                 'state' => $state,
                 'postcode' => $postcode,
                 'country' => $country,
            ];

            if ($firstName == '') {
                array_push($errors, 'El nombre es requerido');
            } else {
                //Si está relleno realizar otras comprobaciones
            }
            if ($lastName1 == '') {
                array_push($errors, 'El primer apellido es requerido');
            }
            if ($email == '') {
                array_push($errors, 'El email es requerido');
            }
            if ($password1 == '') {
                array_push($errors, 'La contraseña es requerida');
            }
            if ($password2 == '') {
                array_push($errors, 'La repetición de contraseña es requerida');
            }
            if ($address == '') {
                array_push($errors, 'La dirección es requerida');
            }
            if ($city == '') {
                array_push($errors, 'La ciudad es requerida');
            }
            if ($state == '') {
                array_push($errors, 'La provincia es requerida');
            }
            if ($postcode == '') {
                array_push($errors, 'El código postal es requerido');
            }
            if ($country == '') {
                array_push($errors, 'El país es requerido');
            }
            if ($password1 != $password2) {
                array_push($errors, 'Ambas claves deben ser iguales');
            }
            if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, 'El correo electrónico no es válido');
            }
            if (count($errors) == 0) {

                if ($this->model->createUser($dataForm)) {

                    $data = [
                        'title' => 'Bienvenido/a',
                        'menu' => false,
                        'subtitle' => 'Bienvenid@ a nuestra tienda virtual',
                        'text' => 'Gracias por registrarse en nuestra web',
                        'color' => 'alert-success',
                        'url' => 'menu',
                        'colorButton' => 'btn-success',
                        'textButton' => 'Iniciar'
                    ];

                    $this->view('mensaje', $data);

                } else {

                    $data = [
                        'title' => 'Error en el registro',
                        'menu' => false,
                        'subtitle' => 'Error en el registro',
                        'text' => 'Se ha producido un error durante el registro del usuario',
                        'color' => 'alert-danger',
                        'url' => 'login',
                        'colorButton' => 'btn-danger',
                        'textButton' => 'Regresar'
                    ];

                    $this->view('mensaje', $data);

                }

            } else {
                $data = [
                    'title' => 'Registro',
                    'menu' => false,
                    'errors' => $errors,
                    'dataForm' => $dataForm,
                ];
                $this->view('register', $data);
            }

        } else {

            $data = [
                'title' => 'Registro',
                'menu' => false,
            ];

            $this->view('register', $data);

        }
    }

    public function olvido()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {

            $data = [
                'title' => 'Olvido de la contraseña',
                'menu' => false,
                'errors' => [],
                'subtitle' => '¿Olvidaste tu contraseña?'
            ];

            $this->view('olvido', $data);

        } else {

            $email = $_POST['email'] ?? '';

            if ($email == '') {
                array_push($errors, 'El email es requerido');
            }

            if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, 'El correo electrónico no es válido');
            }

            if (count($errors) == 0) {

                if ( $this->model->existsEmail($email) ) {
                    if ($this->model->sendEmail($email)) {
                        $data = [
                            'title' => 'Cambio de contraseña',
                            'menu' => false,
                            'subtitle' => 'Cambio de contraseña de acceso',
                            'text' => 'Se ha enviado un correo electrónico a <b>' . $email . '</b> para que pueda cambiar su contraseña. No olvide revisar la carpeta de span.',
                            'color' => 'alert-success',
                            'url' => 'login',
                            'colorButton' => 'btn-success',
                            'textButton' => 'Regresar',
                        ];

                        $this->view('mensaje', $data);
                    } else {

                        $data = [
                            'title' => 'Error con el correo',
                            'menu' => false,
                            'subtitle' => 'Error en el envío del correo electrónico',
                            'text' => 'Existió un problema al enviar el correo electrónico. Pruebe más tarde o comuníquese con nuestro servicio técnico',
                            'color' => 'alert-danger',
                            'url' => 'login',
                            'colorButton' => 'btn-danger',
                            'textButton' => 'Regresar',
                        ];

                        $this->view('mensaje', $data);

                    }
                } else {
                    array_push($errors, 'El correo electrónico no es válido');
                }

            }

            if (count($errors) > 0) {

                $data = [
                    'title' => 'Olvido de la contraseña',
                    'menu' => false,
                    'errors' => $errors,
                    'subtitle' => '¿Olvidaste tu contraseña?'
                ];

                $this->view('olvido', $data);

            }


        }
    }

    public function changePassword($data)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'] ?? '';
            $password1 = $_POST['password1'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            if ($id == '') {
                array_push($errors, 'El usuario no existe');
            }
            if($password1 == '') {
                array_push($errors, 'La contraseña es requerida');
            }
            if($password2 == '') {
                array_push($errors, 'Repetir la contraseña es requerido');
            }
            if ($password1 != $password2) {
                array_push($errors, 'Ambas contraseñas deben ser iguales');
            }

            if (count($errors)) {
                $dataView = [
                    'title' => 'Cambia tu contraseña de acceso',
                    'menu' => false,
                    'errors' => $errors,
                    'data' => $data,
                    'subtitle' => 'Cambia tu contraseña de acceso',
                ];
                $this->view('changepassword', $dataView);
            } else {

                if ($this->model->changePassword($id, $password1)) {

                    $dataView = [
                        'title' => 'Modificar la contraseña',
                        'menu' => false,
                        'subtitle' => 'Modificación de la contraseña',
                        'text' => 'La contraseña ha sido cambiada correctamente. Bienvenid@ de nuevo',
                        'color' => 'alert-success',
                        'url' => 'login',
                        'colorButton' => 'btn-success',
                        'textButton' => 'Regresar',
                    ];

                    $this->view('mensaje', $dataView);

                } else {

                    $dataView = [
                        'title' => 'Error al modificar la contraseña',
                        'menu' => false,
                        'subtitle' => 'Error al modificar la contraseña',
                        'text' => 'La contraseña no ha sido cambiada debido a un error interno. Pruebe otra vez en unos minutos',
                        'color' => 'alert-danger',
                        'url' => 'login',
                        'colorButton' => 'btn-danger',
                        'textButton' => 'Regresar',
                    ];

                    $this->view('mensaje', $dataView);

                }
            }

        } else {

            $dataView = [
                'title' => 'Cambia tu contraseña de acceso',
                'menu' => false,
                'data' => $data,
                'subtitle' => 'Cambia tu contraseña de acceso',
            ];

            $this->view('changepassword', $dataView);
        }
    }

    public function verifyUser()
    {
        $errors = [];

        $user = $_POST['user'] ?? '';
        $password = $_POST['password'] ?? '';
        $remember = $_POST['remember'] ?? '';

        $value = $user . '|' . $password;
        if ($remember == 'on') {
            $date = time() + (60*60*24*7);
        } else {
            $date = time() - 1;
        }

        setcookie('shoplogin', $value, $date, dirname(__DIR__) . ROOT);

        $errors = $this->model->verifyUser($user, $password);

        $dataForm = [
            'user' => $user,
            'password' => $password,
            'remember' => $remember,
        ];

        if ( ! $errors ) {

            $data = $this->model->getUserByEmail($user);
            $session = new Session();
            $session->login($data);

            header('location:' . ROOT . 'shop');
        } else {

            $data = [
                'title' => 'Login',
                'menu' => false,
                'errors' => $errors,
                'data' => $dataForm,
            ];
            $this->view('login', $data);
        }
    }
}