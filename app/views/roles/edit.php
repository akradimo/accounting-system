<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>ویرایش نقش</h1>
        <form action="<?php echo URLROOT; ?>/role/edit/<?php echo $data['id']; ?>" method="post">
            <div class="form-group">
                <label for="name">نام نقش</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
            </div>
            <div class="form-group">
                <label>دسترسی‌ها</label>
                <div>
                    <label><input type="checkbox" name="permissions[]" value="view_roles" <?php echo in_array('view_roles', $data['permissions']) ? 'checked' : ''; ?>> مشاهده نقش‌ها</label><br>
                    <label><input type="checkbox" name="permissions[]" value="add_roles" <?php echo in_array('add_roles', $data['permissions']) ? 'checked' : ''; ?>> افزودن نقش</label><br>
                    <label><input type="checkbox" name="permissions[]" value="edit_roles" <?php echo in_array('edit_roles', $data['permissions']) ? 'checked' : ''; ?>> ویرایش نقش</label><br>
                    <label><input type="checkbox" name="permissions[]" value="delete_roles" <?php echo in_array('delete_roles', $data['permissions']) ? 'checked' : ''; ?>> حذف نقش</label><br>
                </div>
                <span class="text-danger"><?php echo $data['permissions_err']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>
