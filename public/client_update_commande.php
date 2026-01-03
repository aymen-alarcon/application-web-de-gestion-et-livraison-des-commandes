<?php 
    require __DIR__ . '/includes/header.php'; 
    $commandeItems = $_SESSION["commande_items"] ?? [];
?>
    <form action="../src/Controller/UpdateCommandItemHandler.php" method="post">
        <div class="container bg-white rounded mt-3">
            <div class="table-wrap">
                <table id="productsTable" class="table table-hover table-borderless bg-white align-middle">
                    <thead class="table-light p-2">
                        <tr>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th class="text-end">Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <?php foreach ($commandeItems as $commandeItem): ?>
                            <tr>
                                <td class="d-none">
                                    <input type="text" name="id[]" value="<?php if(isset($commandeItem["id"])): echo $commandeItem["id"] ; endif; ?>" hidden>
                                </td>
                                <td>
                                    <input name="product[]" class="form-control bg-dark text-white product-name" value="<?php if(isset($commandeItem["name"])): echo $commandeItem["name"] ; endif; ?>" />
                                </td>
    
                                <td>
                                    <textarea name="description[]" class="form-control bg-dark text-white" rows="1"><?php if(isset($commandeItem["description"])): echo $commandeItem["description"] ; endif; ?></textarea>
                                </td>
    
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>$</span>
                                        <input name="price[]" class="form-control bg-dark text-white unit-price" type="number" value="<?php if(isset($commandeItem["price"])): echo $commandeItem["price"] ; endif; ?>" step="0.01" />
                                    </div>
                                </td>
    
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <a class="btn btn-outline-secondary qty-btn qty-minus">−</a>
                                        <input name="quantity[]" class="form-control bg-dark text-white qty text-center" style="width: 60px;" type="number" value="<?php if(isset($commandeItem["quantity"])): echo $commandeItem["quantity"] ; endif; ?>" style="max-width:70px" />
                                        <a class="btn btn-outline-secondary qty-btn qty-plus">+</a>
                                    </div>
                                </td>
    
                                <td class="text-end">
                                    <span class="subtotal"></span>
                                </td>
    
                                <td>
                                    <a href="../src/Controller/DeleteHandler.php?entityClass=CommandeItem&repositoryClass=CommandeItemRepository&id=<?php if(isset($commandeItem["id"])): echo $commandeItem["id"] ; endif; ?>" class="btn btn-outline-danger delete-row">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    
            <div class="d-flex justify-content-end align-items-center p-3">
                <div style="text-align:right">
                    <div class="total-label text-dark">Order Total</div>
                    <div id="orderTotal" class="text-dark">$10.00</div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
<?php require __DIR__ . '/includes/footer.php'; ?>