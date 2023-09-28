<?php

class LoginController extends Controller
{
    public function index()
    {
        echo "Estoy en index de Login";
    }

    public function metodovariable()
    {
        if (func_num_args() > 0) {
            for ($i = 0; $i < func_num_args(); $i++) {
                print func_get_arg($i) . '<br>';
            }
        } else {
            echo 'No hay argumentos' . '<br>';
        }
    }

    public function metodofijo($arg1 = 'Uno', $arg2 = 'Dos', $arg3 = 'Tres')
    {
        echo $arg1 . '<br>';
        echo $arg2 . '<br>';
        echo $arg3 . '<br>';
    }
}