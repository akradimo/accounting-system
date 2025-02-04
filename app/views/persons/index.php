<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>لیست اشخاص</h1>
        <a href="<?php echo URLROOT; ?>/person/add" class="btn btn-primary mb-3">افزودن شخص</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>نام</th>
                <th>تلفن</th>
                <th>ایمیل</th>
                <th>نوع</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['persons'] as $person) : ?>
                <tr>
                    <td><?php echo $person->name; ?></td>
                    <td><?php echo $person->phone; ?></td>
                    <td><?php echo $person->email; ?></td>
                    <td><?php echo $person->type; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/person/edit/<?php echo $person->id; ?>" class="btn btn-warning">ویرایش</a>
                        <a href="<?php echo URLROOT; ?>/person/delete/<?php echo $person->id; ?>" class="btn btn-danger">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>