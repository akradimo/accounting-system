<?php require_once APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1>افزودن فاکتور</h1>
        <form action="<?php echo URLROOT; ?>/invoice/add" method="post">
            <div class="form-group">
                <label for="invoice_number">شماره فاکتور</label>
                <input type="text" name="invoice_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="person_id">شخص</label>
                <select name="person_id" class="form-control" required>
                    <?php foreach ($data['persons'] as $person) : ?>
                        <option value="<?php echo $person->id; ?>"><?php echo $person->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="type">نوع فاکتور</label>
                <select name="type" class="form-control" required>
                    <option value="فروش">فروش</option>
                    <option value="خرید">خرید</option>
                    <option value="پیش‌فاکتور">پیش‌فاکتور</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">تاریخ</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">توضیحات</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>آیتم‌های فاکتور</label>
                <div id="items">
                    <div class="item row mb-3">
                        <div class="col">
                            <select name="items[0][product_id]" class="form-control" required>
                                <?php foreach ($data['products'] as $product) : ?>
                                    <option value="<?php echo $product->id; ?>"><?php echo $product->product_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="items[0][quantity]" class="form-control" placeholder="تعداد" required>
                        </div>
                        <div class="col">
                            <input type="number" name="items[0][unit_price]" class="form-control" placeholder="قیمت واحد" required>
                        </div>
                        <div class="col">
                            <input type="number" name="items[0][total_price]" class="form-control" placeholder="قیمت کل" required>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-item" class="btn btn-secondary">افزودن آیتم</button>
            </div>
            <div class="form-group">
                <label for="total_amount">مبلغ کل</label>
                <input type="number" name="total_amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>

    <script>
        let itemIndex = 1;
        document.getElementById('add-item').addEventListener('click', function() {
            const itemsDiv = document.getElementById('items');
            const newItem = document.createElement('div');
            newItem.classList.add('item', 'row', 'mb-3');
            newItem.innerHTML = `
            <div class="col">
                <select name="items[${itemIndex}][product_id]" class="form-control" required>
                    <?php foreach ($data['products'] as $product) : ?>
                        <option value="<?php echo $product->id; ?>"><?php echo $product->product_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="تعداد" required>
            </div>
            <div class="col">
                <input type="number" name="items[${itemIndex}][unit_price]" class="form-control" placeholder="قیمت واحد" required>
            </div>
            <div class="col">
                <input type="number" name="items[${itemIndex}][total_price]" class="form-control" placeholder="قیمت کل" required>
            </div>
        `;
            itemsDiv.appendChild(newItem);
            itemIndex++;
        });
    </script>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>