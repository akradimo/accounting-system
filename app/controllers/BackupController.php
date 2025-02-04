<?php
class BackupController extends Controller {
    public function index() {
        $this->view('backup/index');
    }

    public function create() {
        $backup_file = 'backup/backup-' . date("Y-m-d-H-i-s") . '.sql';
        $command = "mysqldump --user=root --password= --host=localhost accounting_system > $backup_file";
        exec($command);

        if (file_exists($backup_file)) {
            redirect('backup/index');
        } else {
            die('خطا در تهیه پشتیبان');
        }
    }
}
?>