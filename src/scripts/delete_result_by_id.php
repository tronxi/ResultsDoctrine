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

$resultRepository = new ResultRepository();

$resultRepository->deleteById($id);

echo "Delete result with ID: " . $id;
