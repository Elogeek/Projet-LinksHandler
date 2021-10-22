<?php

namespace Elogeek\LinksHandler\Controller;

class BaseController {

    /**
     * Render for redirects page into base view page
     * @param string $view
     * @param string $title
     * @param array $data
     */
    public static function render(string $view, string $title, array $data = []) {
        ob_start();
        require dirname(__FILE__) . "/../../View/" . $view . ".view.php";
        $html = ob_get_clean();
        require dirname(__FILE__) . "/../../View/_partials/base.view.php";
    }

}