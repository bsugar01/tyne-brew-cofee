<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Product ID</th>
            <th>Name</th>
            <th>Flavour</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($product as $product): ?>
        <tr>
            <form method="POST">
                <td>
                    <img src="<?= htmlspecialchars($product['image_url']) ?>" style="width: 100px; height: auto;">
                    <input type="hidden" name="image_url" value="<?= htmlspecialchars($product['image_url']) ?>">
                </td>
                <td><?= htmlspecialchars($product['product_id']) ?></td>
                <td>
                    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                </td>
                <td>
                    <input type="text" name="flavour" value="<?= htmlspecialchars($product['flavour']) ?>" required>
                </td>
                <td>
                    <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" step="0.01" required>
                </td>
                <td>
                    <input type="number" name="quantity" value="<?= htmlspecialchars($product['quantity']) ?>" required>
                </td>
                <td>
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <button type="submit" name="edit_product">Save</button>
                    <a href="?delete=<?= $product['product_id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
