<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>گزارش فروش</h1>
        <form action="<?php echo URLROOT; ?>/report/sale" method="post">
            <div class="form-group">
                <label for="start_date">تاریخ شروع</label>
                <input type="date" name="start_date" class="form-control" value="<?php echo $data['start_date']; ?>">
            </div>
            <div class="form-group">
                <label for="end_date">تاریخ پایان</label>
                <input type="date" name="end_date" class="form-control" value="<?php echo $data['end_date']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">نمایش گزارش</button>
        </form>

        <?php if (!empty($data['sales'])) : ?>
            <table class="table table-bordered mt-4">
                <thead>
                <tr>
                    <th>شماره فاکتور</th>
                    <th>شخص</th>
                    <th>مبلغ کل</th>
                    <th>تاریخ</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['sales'] as $sale) : ?>
                    <tr>
                        <td><?php echo $sale->invoice_number; ?></td>
                        <td><?php echo $sale->person_name; ?></td>
                        <td><?php echo number_format($sale->total_amount); ?></td>
                        <td><?php echo $sale->date; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>