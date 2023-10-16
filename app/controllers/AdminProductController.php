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
        $typeConfig = $this->model->getConfig('productType');
        $statusConfig = $this->model->getConfig('productStatus');
        $catalogue = $this->model->getCatalogue();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Recibimos la información
            $type = $_POST['type'] ?? '';
            $name = Validate::text($_POST['name'] ?? '');
            $description = Validate::text($_POST['description'] ?? '');
            $price = Validate::number($_POST['price'] ?? '');
            $discount = Validate::number($_POST['discount'] ?? '0');
            $send = Validate::number($_POST['envio'] ?? '0');
            $image = Validate::file($_FILES['image']['name']);
            $published = $_POST['published'] ?? '';
            $relation1 = $_POST['relation1'] != '' ? $_POST['relation1'] : 0;
            $relation2 = $_POST['relation2'] != '' ? $_POST['relation2'] : 0;
            $relation3 = $_POST['relation3'] != '' ? $_POST['relation3'] : 0;
            $mostSold = isset($_POST['mostSold']) ? '1' : '0';
            $new = isset($_POST['new']) ? '1' : '0';
            $status = $_POST['status'] ?? '';
            //Books
            $author = Validate::text($_POST['author'] ?? '');
            $publisher = Validate::text($_POST['publisher'] ?? '');
            $pages = Validate::number($_POST['pages'] ?? '');
            //Courses
            $people = Validate::text($_POST['people'] ?? '');
            $objetives = Validate::text($_POST['objetives'] ?? '');
            $necesites = Validate::text($_POST['necesites'] ?? '');

            //Validamos la información
            if (empty($name)) {
                array_push($errors, 'El nombre del producto es requerido');
            }
            if (empty($description)) {
                array_push($errors, 'La descripción del producto es requerida');
            }
            if ( ! is_numeric($price)) {
                array_push($errors, 'El precio del producto debe ser un número');
            }
            if ( ! is_numeric($discount)) {
                array_push($errors, 'El descuento del producto debe ser un número');
            }
            if ( ! is_numeric($send)) {
                array_push($errors, 'Los gastos de envío del producto deben ser un número');
            }
            if (is_numeric($price) && is_numeric($discount) && $price < $discount) {
                array_push($errors, 'El descuento no puede ser mayor que el precio');
            }
            if ( ! is_numeric($pages)) {
                $pages = 0;
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
            if ( ! Validate::date($published) ) {
                array_push($errors, 'La fecha o su formato no son correctos');
            } elseif (Validate::dateDif($published)) {
                array_push($errors, 'La fecha de publicación no puede ser posterior a hoy');
            }

            if ($image) {
                if (Validate::imageFile($_FILES['image']['tmp_name'])) {
                    //Comenzamos a tratar la imagen una vez validad
                    $image = strtolower($image);

                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        move_uploaded_file($_FILES['image']['tmp_name'], 'img' . ROOT . $image);
                        Validate::resizeImage($image, 240);
                    } else {
                        array_push($errors, 'Error al subir la imagen');
                    }
                } else {
                    array_push($errors, 'El formato de imagen no es aceptado');
                }
            } else {
                array_push($errors, 'No he recibido la imagen');
            }

            //Creamos el array de datos
            $dataForm = [
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'discount' => $discount,
                'send' => $send,
                'image' => $image,
                'published' => $published,
                'author' => $author,
                'publisher' => $publisher,
                'pages' => $pages,
                'people' => $people,
                'objetives' => $objetives,
                'necesites' => $necesites,
                'mostSold' => $mostSold,
                'new' => $new,
                'relation1' => $relation1,
                'relation2' => $relation2,
                'relation3' => $relation3,
                'status' => $status,
            ];

            if (empty($errors)) {
                //Enviar la información al modelo

                if ($this->model->createProduct($dataForm)) {
                    //Redirigimos al index de productos
                    header('location:' . ROOT . 'adminProduct');
                }
                array_push($errors, 'Se ha producido un error durante la inserción en la BD');
            }
        }

        $data = [
            'title' => 'Administración de Productos - Alta',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'type' => $typeConfig,
            'status' => $statusConfig,
            'catalogue' => $catalogue,
            'data' => $dataForm,
        ];

        $this->view('admin/products/create', $data);
    }

    public function update($id)
    {
        $errors = [];
        $typeConfig = $this->model->getConfig('productType');
        $statusConfig = $this->model->getConfig('productStatus');
        $catalogue = $this->model->getCatalogue();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Recibimos la información
            $type = $_POST['type'] ?? '';
            $name = Validate::text($_POST['name'] ?? '');
            $description = Validate::text($_POST['description'] ?? '');
            $price = Validate::number($_POST['price'] ?? '');
            $discount = Validate::number($_POST['discount'] ?? '0');
            $send = Validate::number($_POST['envio'] ?? '0');
            $image = Validate::file($_FILES['image']['name']);
            $published = $_POST['published'] ?? '';
            $relation1 = $_POST['relation1'] != '' ? $_POST['relation1'] : 0;
            $relation2 = $_POST['relation2'] != '' ? $_POST['relation2'] : 0;
            $relation3 = $_POST['relation3'] != '' ? $_POST['relation3'] : 0;
            $mostSold = isset($_POST['mostSold']) ? '1' : '0';
            $new = isset($_POST['new']) ? '1' : '0';
            $status = $_POST['status'] ?? '';
            //Books
            $author = Validate::text($_POST['author'] ?? '');
            $publisher = Validate::text($_POST['publisher'] ?? '');
            $pages = Validate::number($_POST['pages'] ?? '');
            //Courses
            $people = Validate::text($_POST['people'] ?? '');
            $objetives = Validate::text($_POST['objetives'] ?? '');
            $necesites = Validate::text($_POST['necesites'] ?? '');

            //Validamos la información
            if (empty($name)) {
                array_push($errors, 'El nombre del producto es requerido');
            }
            if (empty($description)) {
                array_push($errors, 'La descripción del producto es requerida');
            }
            if ( ! is_numeric($price)) {
                array_push($errors, 'El precio del producto debe ser un número');
            }
            if ( ! is_numeric($discount)) {
                array_push($errors, 'El descuento del producto debe ser un número');
            }
            if ( ! is_numeric($send)) {
                array_push($errors, 'Los gastos de envío del producto deben ser un número');
            }
            if (is_numeric($price) && is_numeric($discount) && $price < $discount) {
                array_push($errors, 'El descuento no puede ser mayor que el precio');
            }
            if ( ! is_numeric($pages)) {
                $pages = 0;
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
            if ( ! Validate::date($published) ) {
                array_push($errors, 'La fecha o su formato no son correctos');
            } elseif (Validate::dateDif($published)) {
                array_push($errors, 'La fecha de publicación no puede ser posterior a hoy');
            }

            if ($image) {
                if (Validate::imageFile($_FILES['image']['tmp_name'])) {
                    //Comenzamos a tratar la imagen una vez validad
                    $image = strtolower($image);

                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        move_uploaded_file($_FILES['image']['tmp_name'], 'img' . ROOT . $image);
                        Validate::resizeImage($image, 240);
                    } else {
                        array_push($errors, 'Error al subir la imagen');
                    }
                } else {
                    array_push($errors, 'El formato de imagen no es aceptado');
                }
            }

            //Creamos el array de datos
            $dataForm = [
                'id' => $id,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'discount' => $discount,
                'send' => $send,
                'image' => $image,
                'published' => $published,
                'author' => $author,
                'publisher' => $publisher,
                'pages' => $pages,
                'people' => $people,
                'objetives' => $objetives,
                'necesites' => $necesites,
                'mostSold' => $mostSold,
                'new' => $new,
                'relation1' => $relation1,
                'relation2' => $relation2,
                'relation3' => $relation3,
                'status' => $status,
            ];

            if (empty($errors)) {
                //Enviar la información al modelo

                if ( ! $this->model->updateProduct($dataForm)) {
                    //Redirigimos al index de productos
                    header('location:' . ROOT . 'adminProduct');
                }

                array_push($errors, 'Se ha producido un error durante la actualización en la BD');
            }
        }

        $product = $this->model->getProductById($id);

        $data = [
            'title' => 'Administración de Productos - Alta',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'type' => $typeConfig,
            'status' => $statusConfig,
            'catalogue' => $catalogue,
            'product' => $product,
        ];

        $this->view('admin/products/update', $data);
    }

    public function delete($id)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = $this->model->delete($id);

            if (empty($errors)) {
                header('location:' . ROOT . 'adminProduct');
            }
        }

        $product = $this->model->getProductById($id);

        $typeConfig = $this->model->getConfig('productType');

        $data = [
            'title' => 'Administración de Productos - Eliminación',
            'menu'=> false,
            'admin' => true,
            'type' => $typeConfig,
            'product' => $product,
            'errors' => $errors,
        ];

        $this->view('admin/products/delete', $data);
    }
}