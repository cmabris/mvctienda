<?php

class AdminShopController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminShop');
    }

    public function index()
    {
        $session = new Session();

        if ($session->getLogin()) {

            $data = [
                'title' => 'Administración - Inicio',
                'menu' => false,
                'admin' => true,
                'subtitle' => 'Administración de la tienda',
            ];

            $this->view('admin/shop/index', $data);

        } else {
            header('location:' . ROOT . 'admin');
        }


    }
}