<?php

namespace Repositories;

use Doctrine\ORM\EntityRepository;
use Repositories\GenericRepository;

class TagsRepository extends EntityRepository
{

    public function findByCosaId($cosaId) {
        return $this->getEntityManager()->createQuery(
            "SELECT t
             FROM \Tags t
             LEFT JOIN cosas_tags ct
             where ct.cosas_id = $cosaId"
        );
    }
}