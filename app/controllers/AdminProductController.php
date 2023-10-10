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

        $data = [
            'title' => 'Administración de Productos - Alta',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'type' => $type,
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