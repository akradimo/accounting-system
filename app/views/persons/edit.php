<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>ویرایش شخص</h1>
        <form action="<?php echo URLROOT; ?>/person/edit/<?php echo $data['id']; ?>" method="post">
            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" name="name" class="form-control" value="<?php echo $data['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">تلفن</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $data['phone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">ایمیل</label>
                <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>">
            </div>
            <div class="form-group">
                <label for="address">آدرس</label>
                <textarea name="address" class="form-control"><?php echo $data['address']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="type">نوع</label>
                <select name="type" class="form-control" required>
                    <option value="مشتری" <?php echo ($data['type'] == 'مشتری') ? 'selected' : ''; ?>>مشتری</option>
                    <option value="تامین کننده" <?php echo ($data['type'] == 'تامین کننده') ? 'selected' : ''; ?>>تامین کننده</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>