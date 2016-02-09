<?php

namespace Kalkulator\KalkulatorBundle\Repository;

use Doctrine\ORM\EntityRepository;


class DzienRepository extends EntityRepository {
    public function getDzien(\DateTime $data){
	$od = $data->format('Y-m-d 00:00:00');
	$do = $data->format('Y-m-d 23:59:59');
        $qb = $this->createQueryBuilder('p')
                        ->select('p, c, d')
                        ->leftJoin('p.dania', 'c')
			->leftJoin('c.produkty', 'd');
	$qb->where('p.data >= :od AND p.data <= :do')
                        ->setParameter('od', $od)
			->setParameter('do', $do);
	return $qb->getQuery()->getArrayResult();
    }
}

