<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>ویرایش کالا</h1>
        <form action="<?php echo URLROOT; ?>/product/edit/<?php echo $data['id']; ?>" method="post">
            <div class="form-group">
                <label for="group_name">گروه کالا</label>
                <input type="text" name="group_name" class="form-control" value="<?php echo $data['group_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="subgroup_name">زیر گروه</label>
                <input type="text" name="subgroup_name" class="form-control" value="<?php echo $data['subgroup_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="product_name">نام کالا</label>
                <input type="text" name="product_name" class="form-control" value="<?php echo $data['product_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="serial">سریال</label>
                <input type="text" name="serial" class="form-control" value="<?php echo $data['serial']; ?>">
            </div>
            <div class="form-group">
                <label for="barcode">بارکد</label>
                <input type="text" name="barcode" class="form-control" value="<?php echo $data['barcode']; ?>">
            </div>
            <div class="form-group">
                <label for="barcode2">بارکد دوم</label>
                <input type="text" name="barcode2" class="form-control" value="<?php echo $data['barcode2']; ?>">
            </div>
            <div class="form-group">
                <label for="unit">واحد</label>
                <input type="text" name="unit" class="form-control" value="<?php echo $data['unit']; ?>" required>
            </div>
            <div class="form-group">
                <label for="initial_stock">موجودی اولیه</label>
                <input type="number" name="initial_stock" class="form-control" value="<?php echo $data['initial_stock']; ?>" required>
            </div>
            <div class="form-group">
                <label for="purchase_price">قیمت خرید</label>
                <input type="number" name="purchase_price" class="form-control" value="<?php echo $data['purchase_price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="store_purchase_price">قیمت خرید فروشگاه</label>
                <input type="number" name="store_purchase_price" class="form-control" value="<?php echo $data['store_purchase_price']; ?>">
            </div>
            <div class="form-group">
                <label for="purchase_discount">تخفیف خرید</label>
                <input type="number" name="purchase_discount" class="form-control" value="<?php echo $data['purchase_discount']; ?>">
            </div>
            <div class="form-group">
                <label for="sale_price">قیمت فروش</label>
                <input type="number" name="sale_price" class="form-control" value="<?php echo $data['sale_price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="store_sale_price">قیمت فروش فروشگاه</label>
                <input type="number" name="store_sale_price" class="form-control" value="<?php echo $data['store_sale_price']; ?>">
            </div>
            <div class="form-group">
                <label for="sale_discount">تخفیف فروش</label>
                <input type="number" name="sale_discount" class="form-control" value="<?php echo $data['sale_discount']; ?>">
            </div>
            <div class="form-group">
                <label for="tax_percentage">درصد مالیات</label>
                <input type="number" name="tax_percentage" class="form-control" value="<?php echo $data['tax_percentage']; ?>">
            </div>
            <div class="form-group">
                <label for="description">توضیحات</label>
                <textarea name="description" class="form-control"><?php echo $data['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="date">تاریخ</label>
                <input type="date" name="date" class="form-control" value="<?php echo $data['date']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
        </form>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>