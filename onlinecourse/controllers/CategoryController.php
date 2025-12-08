<?php
require_once "models/Category.php";
require_once "core/Auth.php";

class CategoryController {

    public function index() {
        Auth::requireRole([2]); // Admin only
        $model = new Category();
        $categories = $model->all();
        include "views/admin/categories/list.php";
    }

    public function create() {
        Auth::requireRole([2]);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Category();
            $model->create($_POST['name'], $_POST['description']);
            header("Location: index.php?controller=category&action=index");
        }

        include "views/admin/categories/create.php";
    }

    public function edit() {
        Auth::requireRole([2]);
        $model = new Category();
        $category = $model->find($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model->update($_GET['id'], $_POST['name'], $_POST['description']);
            header("Location: index.php?controller=category&action=index");
        }

        include "views/admin/categories/edit.php";
    }

    public function delete() {
        Auth::requireRole([2]);
        $model = new Category();
        $model->delete($_GET['id']);
        header("Location: index.php?controller=category&action=index");
    }
}
