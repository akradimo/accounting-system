<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>لیست تراکنش‌های مالی</h1>
        <a href="<?php echo URLROOT; ?>/financial/add" class="btn btn-primary mb-3">افزودن تراکنش</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>حساب</th>
                <th>نوع</th>
                <th>مبلغ</th>
                <th>تاریخ</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['transactions'] as $transaction) : ?>
                <tr>
                    <td><?php echo $transaction->account_name; ?></td>
                    <td><?php echo $transaction->type; ?></td>
                    <td><?php echo number_format($transaction->amount); ?></td>
                    <td><?php echo $transaction->date; ?></td>
                    <td><?php echo $transaction->description; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/financial/edit/<?php echo $transaction->id; ?>" class="btn btn-warning">ویرایش</a>
                        <a href="<?php echo URLROOT; ?>/financial/delete/<?php echo $transaction->id; ?>" class="btn btn-danger">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>