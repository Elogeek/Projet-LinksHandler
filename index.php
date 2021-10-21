<?php
use App\src\Controller\HomeController;

require 'vendor/autoload.php';


$ctrl = new HomeController();
$ctrl->showHome();