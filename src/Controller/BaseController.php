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
        // If $error is different from null then you display a message in $errorMessage
        if(self::$errorMessage !== null) {
            $error = self::$errorMessage;
            // You must reset $error because otherwise the errors are always displayed
            self::$errorMessage = null;
        }

        if(self::$successMessage !== null) {
            // If $success is different from null then you display a message in $successMessage
            $success = self::$successMessage;
            // You must reset $success because otherwise the success are always displayed
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
        // here $_Post === name['submit'] and 'submit === key (btn)
        return isset($_POST['submit']);
    }

}