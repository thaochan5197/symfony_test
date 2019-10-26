<?php

namespace App\Controller;

use App\Entity\Organizations;
use App\Entity\OrganizationType;
use App\Form\Type\OrganizationsType;
use App\Repository\OrganizationsRepository;
use App\Repository\OrganizationTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/organizations")
 */
class OrganizationController extends AbstractController
{
    /**
     * @Route("/", name="organization_index")
     */
    public function index(OrganizationsRepository $organizationsRepository, OrganizationTypeRepository $organizationsTypeRepository)
    {
        return $this->render('organization/index.html.twig', [
            'organizations' => $organizationsRepository->findAll(),
            'type' => $organizationsTypeRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="organization_new")
     */
    public function new(Request $request)
    {
        $organization = new Organizations();

        $form = $this->createForm(OrganizationsType::class, $organization);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $organization = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($organization);
            $entityManager->flush();

            return $this->redirectToRoute('organization_index');
        }

        return $this->render('organization/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="organization_show", methods={"GET"})
     */
    public function show(Organizations $organization)
    {

        return $this->render('organization/show.html.twig', [
            'organization' => $organization,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="organization_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Organizations $organization)
    {
        $form = $this->createForm(OrganizationsType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('organization_index');
        }

        return $this->render('organization/edit.html.twig', [
            'organization' => $organization,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="organization_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Organizations $organization)
    {
        if ($this->isCsrfTokenValid('delete'.$organization->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($organization);
            $entityManager->flush();
        }

        return $this->redirectToRoute('organization_index');
    }
}
