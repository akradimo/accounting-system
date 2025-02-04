<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>افزودن نقش</h1>
        <form action="<?php echo URLROOT; ?>/role/add" method="post">
            <div class="form-group">
                <label for="name">نام نقش</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
            </div>
            <div class="form-group">
                <label>دسترسی‌ها</label>
                <div>
                    <label><input type="checkbox" name="permissions[]" value="view_roles"> مشاهده نقش‌ها</label><br>
                    <label><input type="checkbox" name="permissions[]" value="add_roles"> افزودن نقش</label><br>
                    <label><input type="checkbox" name="permissions[]" value="edit_roles"> ویرایش نقش</label><br>
                    <label><input type="checkbox" name="permissions[]" value="delete_roles"> حذف نقش</label><br>
                </div>
                <span class="text-danger"><?php echo $data['permissions_err']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>