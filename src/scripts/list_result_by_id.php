<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\repository\ResultRepository;
use MiW\Results\Utility\Utils;

if ($argc <= 1) {
    echo "numero de parametros incorrecto";
    exit(0);
}

$id = (string) $argv[1];

Utils::loadEnv(dirname(__DIR__, 2));

$userRepository = new ResultRepository();

$result = $userRepository->findById($id);

if (in_array('--json', $argv, true)) {
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    echo sprintf(
        '- %2d: %20s %30s',
        $result->getId(),
        $result->getResult(),
        $result->getTime()
    ),PHP_EOL;
}
