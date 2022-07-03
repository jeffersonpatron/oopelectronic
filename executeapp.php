<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use WebApp\Console\Command\PurchaseCommand;

$app = new Application();
$app->add(new PurchaseCommand());
$app->run();