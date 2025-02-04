<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>گزارش فروش ماهانه</h1>
        <form action="<?php echo URLROOT; ?>/report/monthlySales" method="post">
            <div class="form-group">
                <label for="year">سال</label>
                <input type="number" name="year" class="form-control <?php echo (!empty($data['year_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['year']; ?>">
                <span class="invalid-feedback"><?php echo $data['year_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="month">ماه</label>
                <input type="number" name="month" class="form-control <?php echo (!empty($data['month_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['month']; ?>">
                <span class="invalid-feedback"><?php echo $data['month_err']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">نمایش گزارش</button>
        </form>

        <?php if (!empty($data['report'])) : ?>
            <div class="mt-4">
                <h3>فروش ماهانه: <?php echo number_format($data['report']->total_sales); ?></h3>
            </div>
        <?php endif; ?>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>