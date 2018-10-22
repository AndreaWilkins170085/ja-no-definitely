<?php
// src/Controller/LoginController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserProfile;

class LoginController extends AbstractController
{
    /**
    * @Route("/", name="login_view")
    */

    public function newUser(Request $request)
    {
    $form = $this->createForm(Login::class, $user);
    $form->handleRequest($request);
    $form = $this->createForm(Register::class, $user);
    $form->handleRequest($request);
    $view = 'login.html.twig';
    $model = array('form' => $form->createView());
    return $this->render($view, $model);
    }

}
?>