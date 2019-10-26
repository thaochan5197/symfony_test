<?php


namespace App\Controller\Admin;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class UserController extends EasyAdminController
{

    public function deleteAction()
    {
        $id = $this->request->query->get('id');
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $this->denyAccessUnlessGranted('edit', $user);

        return parent::editAction();
    }
}