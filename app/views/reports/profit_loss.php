<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>گزارش سود و زیان</h1>
        <form action="<?php echo URLROOT; ?>/report/profitLoss" method="post">
            <div class="form-group">
                <label for="start_date">تاریخ شروع</label>
                <input type="date" name="start_date" class="form-control <?php echo (!empty($data['start_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['start_date']; ?>">
                <span class="invalid-feedback"><?php echo $data['start_date_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="end_date">تاریخ پایان</label>
                <input type="date" name="end_date" class="form-control <?php echo (!empty($data['end_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['end_date']; ?>">
                <span class="invalid-feedback"><?php echo $data['end_date_err']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">نمایش گزارش</button>
        </form>

        <?php if (!empty($data['report'])) : ?>
            <div class="mt-4">
                <h3>درآمد کل: <?php echo number_format($data['report']->total_income); ?></h3>
                <h3>هزینه کل: <?php echo number_format($data['report']->total_expense); ?></h3>
                <h3>سود خالص: <?php echo number_format($data['report']->total_income - $data['report']->total_expense); ?></h3>
            </div>
        <?php endif; ?>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>