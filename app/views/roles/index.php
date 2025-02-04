<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>لیست نقش‌ها</h1>
        <a href="<?php echo URLROOT; ?>/role/add" class="btn btn-primary mb-3">افزودن نقش</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>نام نقش</th>
                <th>دسترسی‌ها</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['roles'] as $role) : ?>
                <tr>
                    <td><?php echo $role->name; ?></td>
                    <td><?php echo implode(', ', json_decode($role->permissions, true)); ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/role/edit/<?php echo $role->id; ?>" class="btn btn-warning">ویرایش</a>
                        <a href="<?php echo URLROOT; ?>/role/delete/<?php echo $role->id; ?>" class="btn btn-danger">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>