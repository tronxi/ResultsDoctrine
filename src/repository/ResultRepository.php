<?php


namespace MiW\Results\repository;


use Doctrine\Persistence\ObjectRepository;
use MiW\Results\Entity\Result;
use MiW\Results\Utility\Utils;

class ResultRepository
{

    private ObjectRepository $resultRepositoryDoctrine;

    public function __construct() {
        $entityManager = Utils::getEntityManager();
        $this->resultRepositoryDoctrine = $entityManager->getRepository(Result::class);
    }

    public function findById($id): Result {
        return $this->resultRepositoryDoctrine->find($id);
    }

}