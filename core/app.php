<?php

require_once "config.php";


$uri = $_SERVER["REQUEST_URI"];
$cleaned = explode("?", $uri)[0];

route('/Traning/', 'homeController');
route('/Traning/about/', 'aboutController');
route('/Traning/image/(?<id>[\d]+)', 'singleImageController');
list($view, $data) = dispatch($cleaned, 'notFoundController');
extract($data);
