<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>ویرایش پروفایل</h1>
        <form action="<?php echo URLROOT; ?>/user/profile" method="post">
            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="email">ایمیل</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>