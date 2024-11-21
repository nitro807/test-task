<?php
require_once 'CProducts.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['quantity'])) {
    $productId = intval($_POST['id']);
    $quantity = intval($_POST['quantity']);

    $db = new CProducts('localhost', 'root', '', 'test');

    if ($db->updateQuantity($productId, $quantity)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
