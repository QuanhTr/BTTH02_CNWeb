<?php
class HomeController {

    public function index() {
        // Load layout header
        include "views/layouts/header.php";

        // Load content chính
        include "views/home/index.php";

        // Load footer
        include "views/layouts/footer.php";
    }
}
