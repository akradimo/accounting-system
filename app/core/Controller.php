<?php
// app/core/Controller.php

class Controller {
    protected function view($view, $data = []) {
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}