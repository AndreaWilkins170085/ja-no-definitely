<?php 
// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {
    public function index() {
        $view = 'base.html.twig';
         return $this->render($view);
        
    }
}

?>