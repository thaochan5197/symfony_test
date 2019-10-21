<?php


namespace App\Controller\Api;

use FOS\UserBundle\Controller\SecurityController as Login;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
//        dump(1);die;
        return parent::loginAction($request);


    }

    protected function renderLogin(array $data)
    {
        $error = $data['error'];
//        dump($error);
        if (isset($error) && $error instanceof AuthenticationException) {
            return new JsonResponse(["message" => $error->getMessage(), 'status' => 302 ], 200);

        }
        return parent::renderLogin($data);
    }
}