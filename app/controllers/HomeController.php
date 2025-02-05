<?php
// app/controllers/HomeController.php

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'سیستم حسابداری'
        ];
        $this->view('home/index', $data);
    }
}

// app/controllers/HomeController.php

require_once __DIR__ . '/../core/Controller.php'; // اضافه کردن این خط

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'سیستم حسابداری'
        ];
        $this->view('home/index', $data);
    }
}