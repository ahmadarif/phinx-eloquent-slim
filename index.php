<?php
require "vendor/autoload.php";
require "config.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
  'driver' => DB_ADAPTER,
  'host' => DB_HOST,
  'port' => DB_PORT,
  'database' => DB_NAME,
  'username' => DB_USER,
  'password' => DB_PASSWORD,
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci',
]);
$capsule->bootEloquent();
$capsule->setAsGlobal();


// ============================================================
// routes
// ============================================================
$app = new \Slim\App();

$app->get('/create', function(){
    $widget = new \MyProject\Model\Widget();
    $widget->serial_number = 123;
    $widget->name = 'My Test Widget';
    $widget->save();
    echo 'Created!';
});

$app->get('/list', function(){
    $widgets = \MyProject\Model\Widget::all();
    foreach ($widgets as $widget) {
        echo "<h1>$widget->name</h1>";
        echo "<p>Serial number: $widget->serial_number</p>";
    }
});

$app->run();