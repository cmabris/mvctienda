<?php

class AdminCartsController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminCart');
    }

    public function sales()
    {
        $sales = $this->model->sales();

        $data = [
            'title' => 'Ventas',
            'menu' => false,
            'admin' => true,
            'data' => $sales,
        ];
        $this->view('admin/carts/index', $data);
    }
}