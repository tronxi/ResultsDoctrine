<?php

/**
 * PHP version 7.4
 * ResultsDoctrine - controllers.php
 *
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\User;
use MiW\Results\Entity\Result;
use MiW\Results\repository\ResultRepository;
use MiW\Results\repository\UserRepository;
use MiW\Results\Utility\Utils;

function funcionHomePage()
{
    global $routes;
    $createUserForm = $routes->get('create_user_form')->getPath();
    $listUser = $routes->get('ruta_user_list')->getPath();
    $listResults = $routes->get('result_list')->getPath();
    $createResultForm = $routes->get('create_result_form')->getPath();
    echo <<< ____MARCA_FIN
    <div>
        <a href="/ResultsDoctrine/public/index.php{$createUserForm}">Crear usuario</a>
    </div>
    <div>
        <a href="/ResultsDoctrine/public/index.php{$listUser}">Buscar usuarios</a>
    </div>
    <div>
        <a href="/ResultsDoctrine/public/index.php{$listResults}">Buscar Resultados</a>
    </div>
        <div>
        <a href="/ResultsDoctrine/public/index.php{$createResultForm}">Crear Resultado</a>
    </div>

____MARCA_FIN;

}

function findAllResults() {
    $resultRepository = new ResultRepository();
    $results = $resultRepository->findAll();
    foreach ($results as $result) {
        echo <<< ____MARCA_FIN
        <div>
        Id: {$result->getId()}
        Result: {$result->getResult()}
        User: {$result->getUser()}
        Fecha: {$result->getTime()->format('d-m-Y H:i:s')}
        <form action="/ResultsDoctrine/public/index.php/results/{$result->getId()}" method="GET">
            <button type="submit">Borrar</button>
        </form>
        </div>
____MARCA_FIN;
    }
}

function createResultForm() {
    global $routes;
    $createResult = $routes->get('create_result')->getPath();
    echo <<< ____MARCA_FIN
    <form action="/ResultsDoctrine/public/index.php{$createResult}" enctype="multipart/form-data" method="POST">
    <div>
        <label for="result">Result</label>
        <input id="result" name="result">
    </div>
    <div>
        <label for="id">UserId</label>
        <input id="id" name="id">
    </div>
    <button type="submit">Enviar</input>
    </form>
____MARCA_FIN;
}

function createResult() {
    $newResult    = (int) $_POST['result'];
    $userId       = (int) $_POST['id'];
    $newTimestamp =  new DateTime('now');

    $entityManager = Utils::getEntityManager();

    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['id' => $userId]);
    if (null === $user) {
        echo "Usuario $userId no encontrado" . PHP_EOL;
        exit(0);
    }

    $result = new Result($newResult, $user, $newTimestamp);
    try {
        $entityManager->persist($result);
        $entityManager->flush();
        echo 'Created Result with ID ' . $result->getId()
            . ' USER ' . $user->getUsername() . PHP_EOL;
    } catch (Throwable $exception) {
        echo $exception->getMessage();
    }
}

function deleteResult($name) {
    $resultRepository = new ResultRepository();
    $resultRepository->deleteById($name);
}

function createUserForm() {
    global $routes;
    $createUser = $routes->get('create_user')->getPath();
    echo <<< ____MARCA_FIN
    <form action="/ResultsDoctrine/public/index.php{$createUser}" enctype="multipart/form-data" method="POST">
    <div>
        <label for="name">Nombre</label>
        <input id="name" name="name">
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" name="email">
    </div>
    <div>
        <label for="pass">Contraseña</label>
        <input id="pass" name="pass">
    </div>
    <div>
        <label for="enabled">Enabled</label>
        <input type="checkbox" id="enabled" name="enabled">
    </div>
    <div>
        <label for="admin">Admin</label>
        <input id="admin" name="admin" type="checkbox">
    </div>
    <button type="submit">Enviar</input>
    </form>
____MARCA_FIN;
}

function updateUserForm($name) {
    global $routes;
    $updateUser = $routes->get('update_user')->getPath();
    echo <<< ____MARCA_FIN
    <form action="/ResultsDoctrine/public/index.php{$updateUser}" enctype="multipart/form-data" method="POST">
    <div>
        <label for="name">Nombre</label>
        <input id="name" name="name" value="{$name}">
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" name="email">
    </div>
    <div>
        <label for="pass">Contraseña</label>
        <input id="pass" name="pass">
    </div>
    <div>
        <label for="enabled">Enabled</label>
        <input type="checkbox" id="enabled" name="enabled">
    </div>
    <div>
        <label for="admin">Admin</label>
        <input id="admin" name="admin" type="checkbox">
    </div>
    <button type="submit">Enviar</input>
    </form>
____MARCA_FIN;
}

function findAllUsers(): void
{
    $userRepository = new UserRepository();
    $users = $userRepository->findAll();
    foreach ($users as $user) {
        echo <<< ____MARCA_FIN
        <div>
        Id: {$user->getId()}
        Nombre: {$user->getUsername()}
        Email: {$user->getEmail()}
        Enabled: {$user->isEnabled()}
        Admin: {$user->isAdmin()}
        <form action="/ResultsDoctrine/public/index.php/updateuserform/{$user->getUsername()}" method="GET">
            <button type="submit">Editar</button>
        </form>
        <form action="/ResultsDoctrine/public/index.php/users/{$user->getUsername()}" method="POST">
            <button type="submit">Borrar</button>
        </form>
        </div>
____MARCA_FIN;
    }
}

function findUserByName(string $name)
{
    $userRepository = new UserRepository();
    echo json_encode($userRepository->findByName($name));
}

function deleteUserByName(string $name)
{
    $userRepository = new UserRepository();
    $userRepository->deleteByName($name);
    echo "Borrado user " . $name;
}

function createUser() {
    $name = (string) $_POST['name'];
    $email = (string) $_POST['email'];
    $password = (string) $_POST['pass'];
    $enabled = (boolean) $_POST['enabled'];
    $admin = (boolean) $_POST['admin'];

    $user = new User();
    $user->setUsername($name);
    $user->setEmail($email);
    $user->setPassword($password);
    $user->setEnabled($enabled);
    $user->setIsAdmin($admin);

    $userRepository = new UserRepository();
    $userRepository->save($user);
}

function updateUser() {
    $name = (string) $_POST['name'];
    $email = (string) $_POST['email'];
    $password = (string) $_POST['pass'];
    $enabled = (boolean) $_POST['enabled'];
    $admin = (boolean) $_POST['admin'];

    $user = new User();
    $user->setUsername($name);
    $user->setEmail($email);
    $user->setPassword($password);
    $user->setEnabled($enabled);
    $user->setIsAdmin($admin);

    $userRepository = new UserRepository();
    $userRepository->update($user);
}
