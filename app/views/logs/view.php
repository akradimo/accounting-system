<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>جزئیات لاگ</h1>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">کاربر: <?php echo $data['log']->user_name; ?></h5>
                <p class="card-text">عملیات: <?php echo $data['log']->action; ?></p>
                <p class="card-text">توضیحات: <?php echo $data['log']->description; ?></p>
                <p class="card-text">تاریخ: <?php echo $data['log']->created_at; ?></p>
            </div>
        </div>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>