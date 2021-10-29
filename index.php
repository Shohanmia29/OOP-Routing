<?php
require 'Router.php';
$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'views/home.php');
Router::get('about', 'views/about.php');
Router::get('contact', 'views/contact.php');
require Router::run($path);



