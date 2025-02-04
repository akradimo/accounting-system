<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>تنظیمات سیستم</h1>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">نام شرکت: <?php echo $data['settings']->company_name; ?></h5>
                <p class="card-text">آدرس: <?php echo $data['settings']->address; ?></p>
                <p class="card-text">شماره تماس: <?php echo $data['settings']->phone; ?></p>
                <p class="card-text">ایمیل: <?php echo $data['settings']->email; ?></p>
                <p class="card-text">وب‌سایت: <?php echo $data['settings']->website; ?></p>
                <a href="<?php echo URLROOT; ?>/setting/edit" class="btn btn-primary">ویرایش تنظیمات</a>
            </div>
        </div>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>