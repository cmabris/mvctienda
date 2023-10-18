<?php

class ShopController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Shop');
    }

    public function index()
    {
        $session = new Session();

        if ($session->getLogin()) {

            $mostSold = $this->model->getMostSold();
            $news = $this->model->getNews();

            $data = [
                'title' => 'Bienvenid@ a nuestra exclusiva tienda de productos',
                'menu' => true,
                'subtitle' => 'Artículos más vendidos',
                'subtitle2' => 'Artículos nuevos',
                'data' => $mostSold,
                'news' => $news,
            ];

            $this->view('shop/index', $data);
        } else {
            header('location:' . ROOT);
        }
    }

    public function logout()
    {
        $session = new Session();
        $session->logout();
        header('location:' . ROOT);
    }

    public function show($id, $back = '')
    {
        $session = new Session();

        $product = $this->model->getProductById($id);

        $data = [
            'title' => 'Detalle del producto',
            'subtitle' => $product->name,
            'menu' => true,
            'admin' => false,
            'back' => $back,
            'errors' => [],
            'data' => $product,
            'user_id' => $session->getUserId(),
        ];

        $this->view('shop/show', $data);
    }

    public function whoami()
    {
        $session = new Session();

        if ($session->getLogin()) {

            $data = [
                'title' => 'Quienes somos',
                'menu' => true,
                'active' => 'whoami',
            ];

            $this->view('shop/whoami', $data);
        } else {
            header('location:' . ROOT);
        }
    }

    public function contact()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';

            if ($name == '') {
                array_push($errors, 'El nombre es requerido');
            }
            if ($email == '') {
                array_push($errors, 'El email es requerido');
            }
            if ($message == '') {
                array_push($errors, 'El mensaje es requerido');
            }
            if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, 'El correo electrónico no es válido');
            }

            if (count($errors) == 0) {
                if ( $this->model->sendEmail($name, $email, $message)) {
                    $data = [
                        'title' => 'Mensaje de usuario',
                        'menu' => true,
                        'errors' => $errors,
                        'subtitle' => 'Gracias por su mensaje',
                        'text' => 'En breve recibirá noticias nuestras',
                        'color' => 'alert-success',
                        'url' => 'shop',
                        'colorButton' => 'btn-success',
                        'textButton' => 'Regresar',
                    ];
                    $this->view('mensaje', $data);
                } else {
                    $data = [
                        'title' => 'Error en el envió del correo',
                        'menu' => true,
                        'errors' => [],
                        'subtitle' => 'Error en el envió del correo',
                        'text' => 'Existió un problema durante el proceso de envío del correo electrónico',
                        'color' => 'alert-danger',
                        'url' => 'shop',
                        'colorButton' => 'btn-danger',
                        'textButton' => 'Regresar',
                    ];
                    $this->view('mensaje', $data);
                }
            } else {
                $data = [
                    'title' => 'Contacta con nosotros',
                    'menu' => true,
                    'errors' => $errors,
                    'active' => 'contact',
                ];

                $this->view('shop/contact', $data);
            }
        } else {
            $session = new Session();

            if ($session->getLogin()) {

                $data = [
                    'title' => 'Contacta con nosotros',
                    'menu' => true,
                    'active' => 'contact',
                ];

                $this->view('shop/contact', $data);

            } else {
                header('location:' . ROOT);
            }
        }
    }
}