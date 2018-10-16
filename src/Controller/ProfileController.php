<?php
// src/Controller/ProfileController.php
namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserProfile;

class ProfileController extends AbstractController
{
    /**
    * @Route("/profile", name="profile_view")
    */

    public function viewProfilepage()
    {
    $view = 'profile.html.twig';
    return $this->render($view);
    }
}

?>