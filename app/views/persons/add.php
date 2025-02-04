<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>افزودن شخص</h1>
        <form action="<?php echo URLROOT; ?>/person/add" method="post">
            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">تلفن</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">ایمیل</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="address">آدرس</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="type">نوع</label>
                <select name="type" class="form-control" required>
                    <option value="مشتری">مشتری</option>
                    <option value="تامین کننده">تامین کننده</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>