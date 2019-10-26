<?php

namespace App\Controller\Api;

use App\Entity\Staffs;
use App\Entity\User;
use FOS\ElasticaBundle\FOSElasticaBundle;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Form\StaffsType;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class EmployeesController
 * @Route("/api", name="api_")
 */
class StaffsController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/staffs")
     *
     * @return Response
     */
    public function getStaffAction(Request $request,RepositoryManagerInterface $finder)
    {
        $result = $finder->getRepository(User::class)->find('silico');
//        $finder = $this->container->get('fos_elastica.finder.app_user.user');
//        $result = $finder->find('admin');
            $page = $request->query->get('page', 1);
        $qb = $this->getDoctrine()
            ->getRepository(Staffs::class)
            ->findAllQueryBuilder();

        $adapter =new DoctrineORMAdapter($qb);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(2);
        $pagerfanta->setCurrentPage($page);

        $staffs = [];
        foreach ($pagerfanta->getCurrentPageResults() as $staff)
        {
            $staffs[] = $staff;
        }
        $data = [
            'total' => $pagerfanta->getNbResults(),
            'count' => count($staffs),
            'staffs' => $staffs,
            'result' => $result,
        ];
        $data = $this->view($data);

        return $this->handleView($data);
    }
    /**
     * @Rest\Post("/staff")
     *
     * @return Response
     */
    public function postStaffAction(Request $request)
    {
        $staff = new Staffs();
        $form = $this->createForm(StaffsType::class, $staff);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($staff);
            $em->flush();

            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));

    }
}
