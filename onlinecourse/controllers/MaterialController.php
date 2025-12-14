<?php
class MaterialController {
public function upload() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $file = $_FILES['file']['name'];
        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            "assets/uploads/materials/".$file
        );

        (new Material())->upload($_POST['lesson_id'], $file);
        header("Location: back");
    }
}
}