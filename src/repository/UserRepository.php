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
        return $this->userRepositoryDoctrine->findOneBy(array(username => $name));
    }

    public function findAll() {
        return $this->userRepositoryDoctrine->findAll();
    }

    public function save(User $user) {
        $entityManager = Utils::getEntityManager();
        $entityManager->persist($user);
        $entityManager->flush();
    }

    public function deleteByName($name) {
        $user = $this->findByName($name);
        $entityManager = Utils::getEntityManager();
        $entityManager->remove($entityManager->merge($user));
        $entityManager->flush();
    }

    public function update(User $user) {
        $entityManager = Utils::getEntityManager();
        $oldUser = $entityManager->getRepository(User::class)
            ->findOneBy(array(username =>$user->getUsername()));

        $oldUser->setUsername($user->getUsername());
        $oldUser->setEmail($user->getEmail());
        $oldUser->setPassword($user->getPassword());
        $oldUser->setEnabled($user->isEnabled());
        $oldUser->setIsAdmin($user->isAdmin());
        $entityManager->flush();
    }

}