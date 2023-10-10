<?php

class AdminProductController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminProduct');
    }

    public function index()
    {
        $session = new Session();

        if ($session->getLogin()) {
            $products = $this->model->getProducts();
            $type = $this->model->getConfig('productType');

            $data = [
                'title' => 'Administración de Productos',
                'menu' => false,
                'admin' => true,
                'type' => $type,
                'data' => $products,
            ];

            $this->view('admin/products/index', $data);
        } else {
            header('location:' . ROOT . 'admin');
        }
    }

    public function create()
    {
        $errors = [];
        $dataForm = [];
        $type = $this->model->getConfig('productType');
        $status = $this->model->getConfig('productStatus');
        $catalogue = $this->model->getCatalogue();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Recibimos la información
            $type = $_POST['type'] ?? '';
            $name = addslashes(htmlentities($_POST['name'] ?? ''));
            $description = addslashes(htmlentities($_POST['description'] ?? ''));
            $price = $_POST['price'] ?? '';
            $discount = $_POST['discount'] ?? '0';
            $send = $_POST['send'] ?? '0';
            $image = $_FILES['image']['name'];
            $published = $_POST['published'] ?? '';
            $relation1 = $_POST['relation1'] != '' ? $_POST['relation1'] : 0;
            $relation2 = $_POST['relation2'] != '' ? $_POST['relation2'] : 0;
            $relation3 = $_POST['relation3'] != '' ? $_POST['relation3'] : 0;
            $mostSold = $_POST['mostSold'] ?? '';
            $new = $_POST['new'] ?? '';
            $status = $_POST['status'] ?? '';
            //Books
            $author = addslashes(htmlentities($_POST['author'] ?? ''));
            $publisher = addslashes(htmlentities($_POST['publisher'] ?? ''));
            $pages = $_POST['pages'] ?? '';
            //Courses
            $people = addslashes(htmlentities($_POST['people'] ?? ''));
            $objetives = addslashes(htmlentities($_POST['objetives'] ?? ''));
            $necesites = addslashes(htmlentities($_POST['necesites'] ?? ''));

            //Validamos la información
            if (empty($name)) {
                array_push($errors, 'El nombre del producto es requerido');
            }
            if (empty($description)) {
                array_push($errors, 'La descripción del producto es requerida');
            }
            if ($type == 1) {
                if (empty($people)) {
                    array_push($errors, 'El público objetivo es requerido');
                }
                if (empty($objetives)) {
                    array_push($errors, 'Los objetivos del curso son requeridos');
                }
                if (empty($necesites)) {
                    array_push($errors, 'Los requisitos del curso son necesarios');
                }
            } elseif ($type == 2) {
                if (empty($author)) {
                    array_push($errors, 'El autor del libro es requerido');
                }
                if (empty($publisher)) {
                    array_push($errors, 'La editorial del libro es requerida');
                }
            } else {
                array_push($errors, 'Debes seleccionar un tipo válido');
            }

            //Creamos el array de datos
            $dataForm = [
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'author' => $author,
                'publisher' => $publisher,
                'people' => $people,
                'objetives' => $objetives,
                'necesites' => $necesites,
            ];

            var_dump($dataForm);

            if (empty($errors)) {
                //Enviar la información al modelo

                if (empty($errors)) {
                    //Redirigimos al index de productos
                }
            }

        }

        $data = [
            'title' => 'Administración de Productos - Alta',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'type' => $type,
            'status' => $status,
            'catalogue' => $catalogue,
            'data' => $dataForm,
        ];

        $this->view('admin/products/create', $data);
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}