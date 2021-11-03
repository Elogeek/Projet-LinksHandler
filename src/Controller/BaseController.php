<?php

namespace Elogeek\LinksHandler\Controller;

class BaseController {

    /**
     * Render for redirects page into base view page
     * @param string $view
     * @param array $data
     */
    public function render(string $view, array $data = []): void {
        ob_start();
        require __DIR__ . "/../../view/" . $view . ".view.php";
        $html = ob_get_clean();
        require __DIR__ . "/../../view/_partials/base.view.php";
    }

}