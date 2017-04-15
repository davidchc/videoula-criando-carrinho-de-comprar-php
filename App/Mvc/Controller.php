<?php

namespace App\Mvc;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}
