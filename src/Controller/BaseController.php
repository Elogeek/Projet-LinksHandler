<?php

namespace Elogeek\LinksHandler\Controller;

class BaseController {

    private static ?string $successMessage = null;
    private static ?string $errorMessage = null;

    /**
     * Render for redirects page into base view page
     * @param string $view
     * @param array $data
     */
    public function render(string $view, array $data = []): void {
        if(self::$errorMessage !== null) {
            $error = self::$errorMessage;
            self::$errorMessage = null;
        }

        if(self::$successMessage !== null) {
            $success = self::$successMessage;
            self::$successMessage = null;
        }

        ob_start();
        require __DIR__ . "/../../view/" . $view . ".view.php";
        $html = ob_get_clean();
        require __DIR__ . "/../../view/_partials/base.view.php";
    }

    /**
     * Add a success message to be displayed.
     * @param string $message
     */
    public function setSuccessMessage(string $message): void {
        self::$successMessage = $message;
    }

    /**
    * Add an error message to be displayed.
    * @param string $message
    */
    public function setErrorMessage(string $message): void {
        self::$errorMessage = $message;
    }

    /**
     * Check if form was submitted.
     * @return bool
     */
    public function checkFormIsSubmitted(): bool {
        return isset($_POST['submit']);
        // here $_Post === name['submit'] and 'submit === key
    }
}