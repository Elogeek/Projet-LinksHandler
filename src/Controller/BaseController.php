<?php

namespace Elogeek\LinksHandler\Controller;

class BaseController {

    private ?string $successMessage = null;
    private ?string $errorMessage = null;

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

    /**
     * Add a succes message to be displayed.
     * @param string $message
     */
    public function setSuccessMessage(string $message): void {
        $this->successMessage = $message;
    }

    /**
    * Add an error message to be displayed.
    * @param string $message
    */
    public function setErrorMessage(string $message): void {
        $this->errorMessage = $message;
    }

    /**
     * Check if form was submitted.
     * @return bool
     */
    public function checkFormIsSubmitted(): bool {
        return $_SERVER ['REQUEST_METHOD'] === 'POST' && !empty($_POST) && isset($_POST['submit']);
    }

    /**
     *  Return true if all provided parameters was set.
     * @param array $array
     * @param mixed ...$keys
     * @return bool
     */
    public function formNotAllEmpty(array $array, ...$keys): bool {

        foreach ($keys as $key) {
            if (isset($array[$key]) || empty($array[$key])) {
                return false;
            }
        }

        return true;
    }


}