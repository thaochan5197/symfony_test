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
        dump(1);
        return parent::loginAction($request);
    }

    protected function renderLogin(array $data)
    {
        $error = $data['error'];
        dump($data);
        if (isset($error) && $error instanceof AuthenticationException) {

            return JsonResponse::create(["message" => $error->getMessage()],302);
        }

        return parent::renderLogin($data);
    }
}