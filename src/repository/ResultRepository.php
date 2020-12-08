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

    public function deleteById($id) {
        $result = $this->findById($id);
        $entityManager = Utils::getEntityManager();
        $entityManager->remove($entityManager->merge($result));
        $entityManager->flush();
    }

    public function updateById($id, $newResult) {
        $entityManager = Utils::getEntityManager();
        $result = $entityManager->getRepository(Result::class)
            ->find($id);
        $result->setResult($newResult);
        $entityManager->flush();
    }

    public function findAll() {
        return $this->resultRepositoryDoctrine->findAll();
    }

}