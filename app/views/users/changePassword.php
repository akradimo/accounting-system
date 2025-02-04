<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>تغییر رمز عبور</h1>
        <form action="<?php echo URLROOT; ?>/user/changePassword" method="post">
            <div class="form-group">
                <label for="current_password">رمز عبور فعلی</label>
                <input type="password" name="current_password" class="form-control <?php echo (!empty($data['current_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['current_password']; ?>">
                <span class="invalid-feedback"><?php echo $data['current_password_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="new_password">رمز عبور جدید</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($data['new_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['new_password']; ?>">
                <span class="invalid-feedback"><?php echo $data['new_password_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_new_password">تکرار رمز عبور جدید</label>
                <input type="password" name="confirm_new_password" class="form-control <?php echo (!empty($data['confirm_new_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_new_password']; ?>">
                <span class="invalid-feedback"><?php echo $data['confirm_new_password_err']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">تغییر رمز عبور</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>