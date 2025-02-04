<?php
class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'صفحه اصلی'
        ];
        $this->view('home/index', $data);
    }
}
?>