<?php


namespace App\Controller\Admin;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class UserController extends EasyAdminController
{
    public function edit(User $user)
    {
        dump("1");
        $this->denyAccessUnlessGranted('edit', $user);
    }
}