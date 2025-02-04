<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>لیست موجودی انبار</h1>
        <a href="<?php echo URLROOT; ?>/inventory/add" class="btn btn-primary mb-3">افزودن موجودی</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>محصول</th>
                <th>تعداد</th>
                <th>تاریخ</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['inventory'] as $item) : ?>
                <tr>
                    <td><?php echo $item->product_name; ?></td>
                    <td><?php echo $item->quantity; ?></td>
                    <td><?php echo $item->date; ?></td>
                    <td><?php echo $item->description; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/inventory/edit/<?php echo $item->id; ?>" class="btn btn-warning">ویرایش</a>
                        <a href="<?php echo URLROOT; ?>/inventory/delete/<?php echo $item->id; ?>" class="btn btn-danger">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>