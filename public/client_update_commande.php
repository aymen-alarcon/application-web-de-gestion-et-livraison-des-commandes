<?php require __DIR__ . '/includes/header.php'; ?>
    <div class="container bg-white rounded mt-3">
        <div class="table-wrap">
            <table id="productsTable" class="table table-hover table-borderless bg-white align-middle">
                <thead class="table-light p-2">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th class="text-end">Subtotal</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <div class="thumb border rounded" style='width:60px;height:60px;background-size:cover;background-position:center;background-image:url("https://picsum.photos/80")'></div>
                        </td>

                        <td>
                            <input class="form-control bg-dark text-white product-name" value="Sample Product" />
                        </td>

                        <td>
                            <textarea class="form-control bg-dark text-white" rows="1">Short description</textarea>
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span>$</span>
                                <input class="form-control bg-dark text-white unit-price" type="number" value="10.00" step="0.01" />
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <button class="btn btn-outline-secondary qty-btn qty-minus">−</button>
                                <input class="form-control bg-dark text-white qty text-center" style="width: 60px;" type="number" value="1" style="max-width:70px" />
                                <button class="btn btn-outline-secondary qty-btn qty-plus">+</button>
                            </div>
                        </td>

                        <td class="text-end">
                            <span class="subtotal">$10.00</span>
                        </td>

                        <td>
                            <button class="btn btn-outline-danger delete-row">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3">
            <button id="addProductBtn" class="btn btn-outline-secondary">
                + Add Product
            </button>

            <div style="text-align:right">
                <div class="total-label text-dark">Order Total</div>
                <div id="orderTotal" class="text-dark">$10.00</div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-2">
        <button class="btn btn-primary">Save Changes</button>
    </div>
<?php require __DIR__ . '/includes/footer.php'; ?>