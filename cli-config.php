<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'Bootstrap.php';

$entityManager = \Cinema\Factory\EntityManager::factory();
return ConsoleRunner::createHelperSet($entityManager);

