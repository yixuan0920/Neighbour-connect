<?php
    session_start();
    require_once '../connection.php';

    $id = intval($_POST['product_id']);
    $name = htmlspecialchars($_POST['product_name']);
    $price = floatval($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    $users_id = $_SESSION['user_details']['users_id'];


    if($_FILES['image']['name'] !=""){ // If the admin wants to update the immage.
        $img_name = $_FILES['image']['name'];
        $img_path = "/assets/img/$img_name";
        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$img_path);

        $query = "UPDATE products SET name = ?, price = ?, description = ?, image =?, users_id =? WHERE products_id = ?";
        $stmt = $cn->prepare($query);
        $stmt->bind_param('ssssii', $name, $price, $description, $img_path, $users_id, $id);
        $stmt->execute();
        $stmt->close();
        $cn->close();
    }else { //admin only wants to update the details
            $query = "UPDATE products SET name = ?, price = ?, description = ?, users_id = ? WHERE products_id = ?";
            $stmt = $cn->prepare($query);
            $stmt->bind_param('sssii', $name, $price, $description, $users_id, $id);
            $stmt->execute();
            $stmt->close();
            $cn->close();
    }

    header("Location: ". $_SERVER['HTTP_REFERER']);
