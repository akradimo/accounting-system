<?php
class PersonController extends Controller {
    private $personModel;

    public function __construct() {
        $this->personModel = $this->model('PersonModel');
    }

    // نمایش لیست اشخاص
    public function index() {
        $persons = $this->personModel->getPersons();
        $data = [
            'persons' => $persons
        ];
        $this->view('persons/index', $data);
    }

    // افزودن شخص
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'address' => trim($_POST['address']),
                'type' => trim($_POST['type'])
            ];

            if ($this->personModel->addPerson($data)) {
                redirect('person/index');
            } else {
                die('خطا در افزودن شخص');
            }
        } else {
            $data = [
                'name' => '',
                'phone' => '',
                'email' => '',
                'address' => '',
                'type' => ''
            ];
            $this->view('persons/add', $data);
        }
    }

    // ویرایش شخص
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'address' => trim($_POST['address']),
                'type' => trim($_POST['type'])
            ];

            if ($this->personModel->updatePerson($data)) {
                redirect('person/index');
            } else {
                die('خطا در ویرایش شخص');
            }
        } else {
            $person = $this->personModel->getPersonById($id);

            $data = [
                'id' => $id,
                'name' => $person->name,
                'phone' => $person->phone,
                'email' => $person->email,
                'address' => $person->address,
                'type' => $person->type
            ];
            $this->view('persons/edit', $data);
        }
    }

    // حذف شخص
    public function delete($id) {
        if ($this->personModel->deletePerson($id)) {
            redirect('person/index');
        } else {
            die('خطا در حذف شخص');
        }
    }
}
?>