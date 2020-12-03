<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Utility\Utils;
use MiW\Results\repository\UserRepository;

if ($argc <= 1) {
    echo "numero de parametros incorrecto";
    exit(0);
}

$name = (string) $argv[1];

Utils::loadEnv(dirname(__DIR__, 2));

$userRepository = new UserRepository();

$user = $userRepository->findByName($name);

if (in_array('--json', $argv, true)) {
    echo json_encode($user, JSON_PRETTY_PRINT);
} else {
    echo sprintf(
        '- %2d: %20s %30s %7s',
        $user->getId(),
        $user->getUsername(),
        $user->getEmail(),
        ($user->isEnabled()) ? 'true' : 'false'
    ),PHP_EOL;
}
