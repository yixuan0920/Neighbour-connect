<?php
  require_once '../connection.php';
  $orders_id = $_GET['order_id'];
  $complete_id = 3;

  $query = "UPDATE orders SET status_id = ? WHERE order_id = ?";
  $stmt = $cn->prepare($query);
  $stmt->bind_param("ii", $complete_id, $orders_id);
  $stmt->execute();

  $cn->close();
  $stmt->close();
  header("Location: ". $_SERVER["HTTP_REFERER"]);
