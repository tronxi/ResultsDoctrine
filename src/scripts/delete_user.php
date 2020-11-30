<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Utility\Utils;
use MiW\Results\repository\UserRepository;

if ($argc !== 2) {
    echo "numero de parametros incorrecto";
    exit(0);
}

$name = (string) $argv[1];

Utils::loadEnv(dirname(__DIR__, 2));


try {
    $userRepository = new UserRepository();
    $userRepository->deleteByName($name);
    echo 'Delete with Name #' . $name . PHP_EOL;
} catch (Throwable $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
