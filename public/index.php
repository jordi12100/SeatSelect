<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __dir__ . '/../vendor/autoload.php';

$entityManager = \Cinema\Factory\EntityManager::factory();
$seatMapper = new \Cinema\SeatMapper($entityManager);

var_dump($seatMapper->findCinemaById(1));


