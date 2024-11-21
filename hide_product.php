<?php
require_once 'CProducts.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $productId = intval($_POST['id']);
    $db = new CProducts('localhost', 'root', '', 'test');

    if ($db->hideProduct($productId)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
