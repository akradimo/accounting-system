<?php
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';
require 'public/index.php';
$app = new App();

require __DIR__ . '/../app/core/App.php';

$app->run();
?>