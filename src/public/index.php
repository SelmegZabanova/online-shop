<?php
require_once './../Core/Autoload.php';
use Core\Autoload;
use Core\App;
Autoload::registrate(dirname(__DIR__,1));
$app = new App();
$app->run();

