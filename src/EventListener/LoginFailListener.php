<?php


namespace App\EventListener;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class LoginFailListener implements AuthenticationFailureHandlerInterface
{

    public function onSecurityAuthenticationFailure(AuthenticationFailureEvent $event)
    {
        $request = new Request();
        $exception = $event->getAuthenticationException();

        $this->onAuthenticationFailure($request, $exception);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(["message" => 'Login fail', 'status' => 302 ], 302);
    }
}