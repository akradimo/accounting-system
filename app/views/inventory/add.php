<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>افزودن موجودی به انبار</h1>
        <form action="<?php echo URLROOT; ?>/inventory/add" method="post">
            <div class="form-group">
                <label for="product_id">محصول</label>
                <select name="product_id" class="form-control <?php echo (!empty($data['product_id_err'])) ? 'is-invalid' : ''; ?>">
                    <option value="">انتخاب محصول</option>
                    <?php foreach ($data['products'] as $product) : ?>
                        <option value="<?php echo $product->id; ?>"><?php echo $product->product_name; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="invalid-feedback"><?php echo $data['product_id_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="quantity">تعداد</label>
                <input type="number" name="quantity" class="form-control <?php echo (!empty($data['quantity_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['quantity']; ?>">
                <span class="invalid-feedback"><?php echo $data['quantity_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="date">تاریخ</label>
                <input type="date" name="date" class="form-control <?php echo (!empty($data['date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['date']; ?>">
                <span class="invalid-feedback"><?php echo $data['date_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="description">توضیحات</label>
                <textarea name="description" class="form-control"><?php echo $data['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>