<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>لیست کالاها</h1>
        <a href="<?php echo URLROOT; ?>/product/add" class="btn btn-primary mb-3">افزودن کالا</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>نام کالا</th>
                <th>گروه</th>
                <th>زیر گروه</th>
                <th>موجودی</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['products'] as $product) : ?>
                <tr>
                    <td><?php echo $product->product_name; ?></td>
                    <td><?php echo $product->group_name; ?></td>
                    <td><?php echo $product->subgroup_name; ?></td>
                    <td><?php echo $product->initial_stock; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/product/edit/<?php echo $product->id; ?>" class="btn btn-warning">ویرایش</a>
                        <a href="<?php echo URLROOT; ?>/product/delete/<?php echo $product->id; ?>" class="btn btn-danger">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>