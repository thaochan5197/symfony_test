<?php


namespace App\EventListener;

<<<<<<< HEAD
//use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//
//use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
//
//class LoginListener
//{
//
//    public function __construct(UrlGeneratorInterface $router)
//    {
//        $this->router = $router;
//    }
//
//    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
//    {
//
//        $event->getRequest();
//        $url = $this->router->generate('home');
//
//        return new JsonResponse(['message' => 'Login success', 'url' => $url], 200);
//    }
//}

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener implements AuthenticationSuccessHandlerInterface
{
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

//    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
//    {
//
//        $event->getRequest();
//        $url = $this->router->generate('home');
//
//        return new JsonResponse(['message' => 'Login success', 'url' => $url], 200);
//    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $request = $event->getRequest();
        $this->onAuthenticationSuccess($request, $token);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $url = $this->router->generate('home');
        return new JsonResponse(['message' => 'Login success', 'url' => $url], 200);
    }

}
=======

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

//        $user->setConfirmationToken("1");
//
//        $this->em->persist($user);
//        $this->em->flush();
    }
}
>>>>>>> b234d4564e5950ed622a32a2fe27588a0a960c9e
