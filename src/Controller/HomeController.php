<?php
namespace App\src\Controller;

use BaseController;

class  HomeController extends BaseController {

    /**
     * Display home of the site
     */
    public function showHome() {
        require_once './View/_partials/base.view.php';

    }
}