<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;
use MiW\Results\repository\UserRepository;

if ($argc !== 6) {
    echo "numero de parametros incorrecto";
    exit(0);
}

$name = (string) $argv[1];
$email = (string) $argv[2];
$password = (string) $argv[3];
$enabled = (boolean) $argv[4];
$admin = (boolean) $argv[5];

Utils::loadEnv(dirname(__DIR__, 2));

$user = new User();
$user->setUsername($name);
$user->setEmail($email);
$user->setPassword($password);
$user->setEnabled($enabled);
$user->setIsAdmin($admin);

try {
    $userRepository = new UserRepository();
    $userRepository->update($user);
    echo 'Update User with name ' . $user->getUsername() . PHP_EOL;
} catch (Throwable $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
