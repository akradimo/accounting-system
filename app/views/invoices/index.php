<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>لیست فاکتورها</h1>
        <a href="<?php echo URLROOT; ?>/invoice/add" class="btn btn-primary mb-3">افزودن فاکتور</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>شماره فاکتور</th>
                <th>شخص</th>
                <th>نوع</th>
                <th>مبلغ کل</th>
                <th>تاریخ</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['invoices'] as $invoice) : ?>
                <tr>
                    <td><?php echo $invoice->invoice_number; ?></td>
                    <td><?php echo $invoice->person_name; ?></td>
                    <td><?php echo $invoice->type; ?></td>
                    <td><?php echo number_format($invoice->total_amount); ?></td>
                    <td><?php echo $invoice->date; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/invoice/view/<?php echo $invoice->id; ?>" class="btn btn-info">مشاهده</a>
                        <a href="<?php echo URLROOT; ?>/invoice/delete/<?php echo $invoice->id; ?>" class="btn btn-danger">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>