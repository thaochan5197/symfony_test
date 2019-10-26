<?php


namespace App\Controller\Api;

use FOS\UserBundle\Controller\SecurityController as Login;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;


/**
 * Class SecurityController
 * @Route("/security", name="security_")
 */
class SecurityController extends Login
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        return parent::loginAction($request);
    }


}