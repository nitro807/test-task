<?php
require_once 'CProducts.php';

$db = new CProducts('localhost', 'root', '', 'test');
$products = $db->getProducts(10);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Article</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="product-table">
            <?php foreach ($products as $product): ?>
                <tr data-id="<?= $product['ID'] ?>">
                    <td><?= $product['ID'] ?></td>
                    <td><?= $product['PRODUCT_ID'] ?></td>
                    <td><?= $product['PRODUCT_NAME'] ?></td>
                    <td><?= $product['PRODUCT_PRICE'] ?></td>
                    <td><?= $product['PRODUCT_ARTICLE'] ?></td>
                    <td>
                        <button class="decrement">-</button>
                        <span class="quantity"><?= $product['PRODUCT_QUANTITY'] ?></span>
                        <button class="increment">+</button>
                    </td>
                    <td><?= $product['DATE_CREATE'] ?></td>
                    <td><button class="hide-button">Скрыть</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        // Увеличение/уменьшение количества товара
        document.querySelectorAll('.increment').forEach(button => {
            button.addEventListener('click', function() {
                updateQuantity(this, 1);
            });
        });

        document.querySelectorAll('.decrement').forEach(button => {
            button.addEventListener('click', function() {
                updateQuantity(this, -1);
            });
        });

        function updateQuantity(button, change) {
            const row = button.closest('tr');
            const productId = row.getAttribute('data-id');
            const quantitySpan = row.querySelector('.quantity');
            let quantity = parseInt(quantitySpan.textContent);

            // Обновляем количество на стороне клиента
            quantity += change;
            if (quantity < 0) quantity = 0; // Не допускаем отрицательных значений
            quantitySpan.textContent = quantity;

            // Отправляем запрос на сервер
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_quantity.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status !== 200 || xhr.responseText !== 'success') {
                    alert('Ошибка при обновлении количества!');
                }
            };
            xhr.send('id=' + productId + '&quantity=' + quantity);
        }

        // Скрытие строки товара по клику на кнопку "Скрыть"
        document.querySelectorAll('.hide-button').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const productId = row.getAttribute('data-id');

                // AJAX-запрос на сервер
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'hide_product.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200 && xhr.responseText === 'success') {
                        // Убираем строку из таблицы
                        row.classList.add('hidden');
                    } else {
                        alert('Ошибка при скрытии товара.');
                    }
                };
                xhr.send('id=' + productId);
            });
        });
    </script>
</body>

</html>