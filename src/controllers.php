<?php

/**
 * PHP version 7.4
 * ResultsDoctrine - controllers.php
 *
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\User;
use MiW\Results\repository\UserRepository;

function funcionHomePage()
{
    global $routes;

    $rutaListado = $routes->get('ruta_user_list')->getPath();
    echo <<< ____MARCA_FIN
    <ul>
        <li><a href="$rutaListado">Listado Usuarios</a></li>
    </ul>
____MARCA_FIN;
}

function findAllUsers(): void
{
    $userRepository = new UserRepository();
    echo json_encode($userRepository->findAll());
}

function findUserByName(string $name)
{
    $userRepository = new UserRepository();
    echo json_encode($userRepository->findByName($name));
}

function deleteUser(string $name)
{
    //todo como se borra es un misterio
}
