<?php

namespace App\Repository;

use App\Entity\Staffs;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;


/**
 * @method Staffs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Staffs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Staffs[]    findAll()
 * @method Staffs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaffsRepository extends NestedTreeRepository
{
    public function findByName($name)
    {
        $qb = $this->createQueryBuilder('s')
            ->where($qb->expr()->like('p.name', ':name'))
            ->setParameter('name', '%' . $name . '%');
        $query = $qb->getQuery();

        return$query->execute();
    }

    public function findAllQueryBuilder()
    {
        return $this->createQueryBuilder('staff');
    }
}
