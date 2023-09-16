<?php

namespace App\Repository;

use App\Entity\Register;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Register>
 *
 * @method Register|null find($id, $lockMode = null, $lockVersion = null)
 * @method Register|null findOneBy(array $criteria, array $orderBy = null)
 * @method Register[]    findAll()
 * @method Register[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegisterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Register::class);
    }
}
