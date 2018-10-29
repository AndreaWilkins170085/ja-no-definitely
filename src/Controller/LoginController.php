<?php
// src/Controller/LoginController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserAccount;
use App\Form\LoginType;
use App\Form\RegisterType;

class LoginController extends AbstractController
{
    /**
    * @Route("/", name="login_view")
    */

    public function userLogin(Request $request)
    {

            $userReg = new UserAccount();

            $loginForm = $this->createForm(LoginType::class);
            $loginForm->handleRequest($request);
 

            if ($loginForm->isSubmitted() && $loginForm->isValid()) {

                $userLog = $loginForm->getData();
                return $this->redirectToRoute('home_view');
            }

            $registerForm = $this->createForm(RegisterType::class, $userReg );
            $registerForm->handleRequest($request);

            if ($registerForm->isSubmitted() && $registerForm->isValid()) {

                $userReg = $registerForm->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($userReg);
                $entityManager->flush();
                    
                return $this->redirectToRoute('home_view');
            }

            $view = 'login.html.twig';
            $model = array('loginForm' => $loginForm->createView(), 'registerForm' => $registerForm->createView());

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