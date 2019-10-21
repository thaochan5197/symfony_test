<?php

namespace App\Controller;

use App\Entity\Staffs;
use App\Form\StaffsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/staffs")
 */
class StaffsController extends AbstractController
{
    /**
     * @Route("/", name="staffs_index", methods={"GET"})
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Staffs::class);
        return $this->render('staffs/index.html.twig', [
            'staffs' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="staffs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $staff = new Staffs();
        $form = $this->createForm(StaffsType::class, $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($staff);
            $entityManager->flush();

            return $this->redirectToRoute('staffs_index');
        }

        return $this->render('staffs/new.html.twig', [
            'staff' => $staff,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="staffs_show", methods={"GET"})
     */
    public function show(Staffs $staff): Response
    {
        return $this->render('staffs/show.html.twig', [
            'staff' => $staff,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="staffs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Staffs $staff): Response
    {
        $form = $this->createForm(StaffsType::class, $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('staffs_index');
        }

        return $this->render('staffs/edit.html.twig', [
            'staff' => $staff,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="staffs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Staffs $staff): Response
    {
        if ($this->isCsrfTokenValid('delete'.$staff->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($staff);
            $entityManager->flush();
        }

        return $this->redirectToRoute('staffs_index');
    }

    /**
     * @Route("/{id}/showList", name="staff_show_list_employees", methods={"GET"})
     */
    public function showList(Staffs $staff)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Staffs::class);
        $employees = $repo->children($staff);
        return $this->render('staffs/list.html.twig', [
            'employees' => $employees,
        ]);
    }
}
