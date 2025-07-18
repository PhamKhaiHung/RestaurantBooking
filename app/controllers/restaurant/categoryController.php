<?php

class CategoryController extends Controller {
    public function hideCategory($id) {
        $this->model('cateresModel')->updateStatusCategory($id, 0);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function showCategory($id) {
        $this->model('cateresModel')->updateStatusCategory($id, 1);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    public function addCategory() {
        $name = $_POST['categoryName'];
        $this->model('cateresModel')->addCategory($name);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    public function updateCategory() {
        $id = $_POST['categoryId'];
        $name = $_POST['categoryName'];
       
        $this->model('cateresModel')->updateCategory($name, $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
   

    
    
} 