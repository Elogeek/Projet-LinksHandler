<?php

class BaseController {

    /**
     * @param string $view
     * @param null $data
     */
    public function render(string $view, $data = null) {
        require dirname(__FILE__) . "/../../View/$view";
    }

}