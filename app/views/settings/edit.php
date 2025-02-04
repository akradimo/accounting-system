<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>ویرایش تنظیمات سیستم</h1>
        <form action="<?php echo URLROOT; ?>/setting/edit" method="post">
            <div class="form-group">
                <label for="company_name">نام شرکت</label>
                <input type="text" name="company_name" class="form-control <?php echo (!empty($data['company_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['company_name']; ?>">
                <span class="invalid-feedback"><?php echo $data['company_name_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="address">آدرس</label>
                <input type="text" name="address" class="form-control <?php echo (!empty($data['address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address']; ?>">
                <span class="invalid-feedback"><?php echo $data['address_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="phone">شماره تماس</label>
                <input type="text" name="phone" class="form-control <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
                <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="email">ایمیل</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="website">وب‌سایت</label>
                <input type="text" name="website" class="form-control <?php echo (!empty($data['website_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['website']; ?>">
                <span class="invalid-feedback"><?php echo $data['website_err']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>