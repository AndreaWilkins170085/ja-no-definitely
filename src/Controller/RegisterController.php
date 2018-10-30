<?php
// src/Controller/LoginController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserAccount;
use App\Form\RegisterType;

class RegisterController extends AbstractController
{
    /**
    * @Route("/register", name="register_view")
    */

    public function userRegister(Request $request)
    {

            $userReg = new UserAccount();

            $registerForm = $this->createForm(RegisterType::class, $userReg );
            $registerForm->handleRequest($request);

            if ($registerForm->isSubmitted() && $registerForm->isValid()) {

                $userReg = $registerForm->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($userReg);
                $entityManager->flush();
                    
                return $this->redirectToRoute('home_view');
            }

            $view = 'register.html.twig';
            $model = array('registerForm' => $registerForm->createView());

            return $this->render($view, $model);
        }

}

?>