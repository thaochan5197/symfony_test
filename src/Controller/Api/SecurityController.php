<?php


namespace App\Controller\Api;

use FOS\UserBundle\Controller\SecurityController as Login;
<<<<<<< HEAD

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
=======
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
>>>>>>> b234d4564e5950ed622a32a2fe27588a0a960c9e
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
<<<<<<< HEAD
//        dump(1);die;
        return parent::loginAction($request);


=======
        return parent::loginAction($request);
>>>>>>> b234d4564e5950ed622a32a2fe27588a0a960c9e
    }

    protected function renderLogin(array $data)
    {
        $error = $data['error'];
<<<<<<< HEAD
//        dump($error);
        if (isset($error) && $error instanceof AuthenticationException) {
            return new JsonResponse(["message" => $error->getMessage(), 'status' => 302 ], 200);
=======
        dump($error);
        if (isset($error) && $error instanceof AuthenticationException) {
            return JsonResponse::create(["message" => $error->getMessage()],302);
>>>>>>> b234d4564e5950ed622a32a2fe27588a0a960c9e

        }
        return parent::renderLogin($data);
    }
}