<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>لیست لاگ‌ها</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>کاربر</th>
                <th>عملیات</th>
                <th>توضیحات</th>
                <th>تاریخ</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['logs'] as $log) : ?>
                <tr>
                    <td><?php echo $log->user_name; ?></td>
                    <td><?php echo $log->action; ?></td>
                    <td><?php echo $log->description; ?></td>
                    <td><?php echo $log->created_at; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/log/view/<?php echo $log->id; ?>" class="btn btn-info">مشاهده</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>