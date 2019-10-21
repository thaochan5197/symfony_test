<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        if($this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('easyadmin');
        }
        else
        {
            return $this->redirectToRoute('fos_user_profile_show');
        }
    }
}
