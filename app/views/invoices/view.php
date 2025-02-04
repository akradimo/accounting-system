<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>جزئیات فاکتور</h1>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">شماره فاکتور: <?php echo $data['invoice']->invoice_number; ?></h5>
                <p class="card-text">شخص: <?php echo $data['invoice']->person_name; ?></p>
                <p class="card-text">نوع: <?php echo $data['invoice']->type; ?></p>
                <p class="card-text">مبلغ کل: <?php echo number_format($data['invoice']->total_amount); ?></p>
                <p class="card-text">تاریخ: <?php echo $data['invoice']->date; ?></p>
                <p class="card-text">توضیحات: <?php echo $data['invoice']->description; ?></p>
            </div>
        </div>
        <h3>آیتم‌های فاکتور</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>نام کالا</th>
                <th>تعداد</th>
                <th>قیمت واحد</th>
                <th>قیمت کل</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['items'] as $item) : ?>
                <tr>
                    <td><?php echo $item->product_name; ?></td>
                    <td><?php echo $item->quantity; ?></td>
                    <td><?php echo number_format($item->unit_price); ?></td>
                    <td><?php echo number_format($item->total_price); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>