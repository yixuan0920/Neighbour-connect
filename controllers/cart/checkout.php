<?php
session_start();
require_once '../connection.php';
date_default_timezone_set("Asia/Kuala_Lumpur");


if(isset($_SESSION['cart'])) {
    $users_id = $_SESSION['user_details']['users_id'];
    $total = 0;
    $transaction_code = "TSC-".date('His')."-".mt_rand();
    $status_id = 1;




    $order_query = "INSERT INTO orders (users_id, status_id, total, transaction_code) VALUES (?, ?, ?, ?)";   //change
    $order_stmt = $cn->prepare($order_query);
    $order_stmt->bind_param('iiss', $users_id, $status_id, $total, $transaction_code);     //change
    $order_stmt->execute();
    $order_id = $order_stmt->insert_id; //this will return you the primary key from your last query


    foreach($_SESSION['cart'] as $id => $quantity) {
        $product_query = "SELECT * FROM products WHERE products_id = ?";
        $product_stmt = $cn->prepare($product_query);
        $product_stmt->bind_param("i", $id);
        $product_stmt->execute();
        $product_result = $product_stmt->get_result();
        $product = $product_result->fetch_assoc();

        $seller_id = $product["users_id"];    //new
	
        $total += ($product['price'] * $quantity);

        $order_products_query = "INSERT INTO order_products(products_id, order_id, seller_id, quantity) VALUES(?, ?, ?, ?)";

        $order_products_stmt = $cn->prepare($order_products_query);
        $order_products_stmt->bind_param('iiii', $id, $order_id, $seller_id, $quantity );   //new
        $order_products_stmt->execute();

    }

    $update_order = "UPDATE orders SET total = ? WHERE order_id = ?";
    $update_order_stmt = $cn->prepare($update_order);
    $update_order_stmt->bind_param("si", $total, $order_id);
    $update_order_stmt->execute();


    $cn->close();
    $order_stmt->close();
    $update_order_stmt->close();
    unset($_SESSION['cart']);
    header("Location: /views/forms/mycart.php");
}
