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
            $name = '';
            $surname='';
            $usernameT='';
            $emailT='';
            $errors='';
            $valid= true;
            $usernameCheck = '';

            $userReg = new UserAccount();

            $registerForm = $this->createForm(RegisterType::class, $userReg );
            $registerForm->handleRequest($request);
            $data = $registerForm->getData();


            if ($registerForm->isSubmitted()) {
                
                $email = $data->{'email'};
                $username = $data->{'username'};
                $password = $data->{'password'};

                $repository = $this->getDoctrine()->getRepository(UserAccount::class);
                
                $emailCheck = $repository->findOneBy(['email' => $email]);
                $usernameCheck = $repository->findOneBy(['username' => $username]);

                // $usernameCheck->createQueryBuilder('a')
                //     ->where('upper(a.username) = upper(:username)')
                //     ->setParameter('username', $username)
                //     ->getQuery()
                //     ->execute();
                
                if (!$emailCheck == null){
                    $emailT='This email has been already registered';
                    $valid = false;
                }
                if (!$usernameCheck == null){
                    $usernameT='This username has been already registered';
                    $valid = false;
                }
                if (strlen($password) < 8) {
                    $errors = "The password should be at least 8 characters";
                    $valid = false;
                }

                if ($valid){
                $userReg->setEncodedPassword($password);
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
                
            }

            $view = 'register.html.twig';
            $model = array('registerForm' => $registerForm->createView(), 'name'=>$name, 'surname'=>$surname, 'usernameT'=>$usernameT, 'emailT'=>$emailT, 'errors'=>$errors);
            

            return $this->render($view, $model);
        }

}
?>