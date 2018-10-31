<?php
    // src/Controller/SessionController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
    use App\Entity\UserAccount;
    use App\Form\LoginType;

    class SessionsController extends AbstractController
    {
    /**
    * @Route("/", name="session_new")
    */

    public function newSession(Request $request, SessionInterface $session)
    {

        $userProfile = new UserAccount();

        $loginForm = $this->createForm(LoginType::class);
        $loginForm->handleRequest($request);
 

            if ($loginForm->isSubmitted() && $loginForm->isValid()) {

                $repository = $this->getDoctrine()->getRepository(UserAccount::class);
                $formAccount = $loginForm->getData();
                $databaseAccount = $repository->findOneBy(['email' => $formAccount['email']]);
                if ($this->validCredentials($formAccount, $databaseAccount))
                {
                    $session->start();
                    $session->set('loggedInUser', $databaseAccount);
                    return $this->redirectToRoute('home_view');
                }

            }
    

        $view = 'login.html.twig';
        $model = array('loginForm' => $loginForm->createView());
        return $this->render($view, $model);

    }

    /**
    * @Route("/logout", name="session_destroy")
    */

    public function destroySession(Request $request, SessionInterface $session)
    {
        $session->invalidate();
        return $this->redirectToRoute('session_new');
    }


    public function validCredentials($formProfile, $databaseProfile)
    {
        $encoder = new BCryptPasswordEncoder(12);
        $userExists = ($databaseProfile != null);
        if ($userExists)
        {
            return $encoder->isPasswordValid($databaseProfile->getEncodedPassword(), $formProfile['password'], null);
        }
        else
        {
            return false;
        }
    }
    }
?>