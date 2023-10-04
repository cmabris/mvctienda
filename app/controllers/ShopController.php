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
        $data = [
            'title' => 'Bienvenid@ a nuestra exclusiva tienda de productos',
            'menu' => false,
        ];

        $this->view('shop/index', $data);
    }
}