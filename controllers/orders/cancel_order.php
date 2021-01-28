<?php
  require_once '../connection.php';
  $order_id = $_GET['order_id'];
  $cancel_id = 2;

  $query = "UPDATE orders SET status_id = ? WHERE order_id = ?";
  $stmt = $cn->prepare($query);
  $stmt->bind_param("ii", $cancel_id, $order_id);
  $stmt->execute();

  $cn->close();
  $stmt->close();
  header("Location: ". $_SERVER["HTTP_REFERER"]);