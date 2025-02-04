<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>گزارش امور مالی</h1>
        <form action="<?php echo URLROOT; ?>/report/financial" method="post">
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

        <?php if (!empty($data['financials'])) : ?>
            <table class="table table-bordered mt-4">
                <thead>
                <tr>
                    <th>نوع</th>
                    <th>مبلغ کل</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['financials'] as $financial) : ?>
                    <tr>
                        <td><?php echo $financial->type; ?></td>
                        <td><?php echo number_format($financial->total); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>