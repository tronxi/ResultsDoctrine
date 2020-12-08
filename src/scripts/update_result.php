<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\repository\ResultRepository;
use MiW\Results\Utility\Utils;

if ($argc <= 2) {
    echo "numero de parametros incorrecto";
    exit(0);
}

$id = (string) $argv[1];
$newSore = (string) $argv[2];

Utils::loadEnv(dirname(__DIR__, 2));

$resultRepository = new ResultRepository();

$resultRepository->updateById($id, $newSore);

echo "Actualizado result con ID: " .$id;
