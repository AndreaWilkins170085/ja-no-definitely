<?php
// src/Controller/LoginController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\UserAccount;
use App\Form\RegisterType;

class RegisterController extends AbstractController
{
    /**
    * @Route("/register", name="register_view")
    */

    public function userRegister(Request $request, SessionInterface $session)
    {

            $userReg = new UserAccount();

            $registerForm = $this->createForm(RegisterType::class, $userReg );
            $registerForm->handleRequest($request);


            if ($registerForm->isSubmitted() && $registerForm->isValid()) {

                $userReg = $registerForm->getData();
                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($userReg);
                $entityManager->flush();

                $repository = $this->getDoctrine()->getRepository(UserAccount::class);
                $loggedInUser = $repository->findOneBy(['email' => $userReg->getEmail()]);

                $session->start();
                $session->set('loggedInUser', $loggedInUser);

                return $this->redirectToRoute('home_view');
            }

            $view = 'register.html.twig';
            $model = array('registerForm' => $registerForm->createView());

            return $this->render($view, $model);
        }


        public function createCredentials() 
    {

        $encoder = new BCryptPasswordEncoder(12);
        
    }

   

}
?>