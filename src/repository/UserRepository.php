<?php

namespace MiW\Results\repository;

use Doctrine\Persistence\ObjectRepository;
use MiW\Results\Utility\Utils;
use MiW\Results\Entity\User;

class UserRepository
{
    private ObjectRepository $userRepositoryDoctrine;

    public function __construct() {
        $entityManager = Utils::getEntityManager();
        $this->userRepositoryDoctrine = $entityManager->getRepository(User::class);
    }

    public function findByName($name): User {
        return $this->userRepositoryDoctrine->findBy(array(username => $name))[0];
    }

    public function findAll() {
        return $this->userRepositoryDoctrine->findAll();
    }

    public function save(User $user) {
        $entityManager = Utils::getEntityManager();
        $entityManager->persist($user);
        $entityManager->flush();
    }
}