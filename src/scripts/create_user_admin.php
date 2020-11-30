<?php

/**
 * PHP version 7.4
 * src/create_user_admin.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;

Utils::loadEnv(dirname(__DIR__, 2));

$newTimestamp = $argv[3] ?? new DateTime('now');

$entityManager = Utils::getEntityManager();

$user = new User();
$user->setUsername($_ENV['ADMIN_USER_NAME']);
$user->setEmail($_ENV['ADMIN_USER_EMAIL']);
$user->setPassword($_ENV['ADMIN_USER_PASSWD']);
$user->setEnabled(true);
$user->setIsAdmin(true);

try {
    $entityManager->persist($user);
    $entityManager->flush();
    echo 'Created User with ID #' . $user->getId() . PHP_EOL;
} catch (Throwable $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
