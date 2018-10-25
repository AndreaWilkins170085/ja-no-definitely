<?php
// src/Controller/LoginController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegisterType;

class LoginController extends AbstractController
{
    /**
    * @Route("/", name="login_view")
    */

    public function userRegister(Request $request)
    {
        $user = new User();

        $registerForm = $this->createForm(RegisterType::class, $user);
        $registerForm->handleRequest($request);

        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            // $form->getData() holds the submitted values
            $user = $registerForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            
            return $this->redirectToRoute('home_view');
        }

        $view = 'login.html.twig';
        $model = array('registerForm' => $registerForm->createView());

        return $this->render($view, $model);
    }

    

    public function userLogin(Request $request)
    {
        $loginForm = $this->createForm(LoginType::class, $user);
        $loginForm->handleRequest($request);
 

        if ($loginForm->isSubmitted() && $loginForm->isValid()) {
            // $form->getData() holds the submitted values
            $user = $loginForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            return $this->redirectToRoute('home_view');
        }

        $view = 'login.html.twig';
        $model = array('loginForm' => $loginForm->createView());

        return $this->render($view, $model);

    }

}



// $test = hash( "sha256", "data");
// echo $test;
// echo '<br />';
// $test2 = hash( "sha256", "data1");
// echo $test;
// echo '<br />';

// if ($test === $test2){
//     echo "true";
// }else{
//     echo "false";
// }

?>