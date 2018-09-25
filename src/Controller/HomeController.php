<?php 
// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {
    public function index() {
        return new Response('<html><body><h1>Ja-No-Definitely</h1></body></html>'
        );
    }
}

?>