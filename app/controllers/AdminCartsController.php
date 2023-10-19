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
        $data = $this->model->sales();
    }
}