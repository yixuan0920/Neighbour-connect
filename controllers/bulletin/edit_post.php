<?php
    session_start();
    require_once '../connection.php';

    $id = intval($_POST['bulletin_id']);
    $title = htmlspecialchars($_POST['bulletin_title']);
    $description = htmlspecialchars($_POST['description']);

    if($_FILES['image']['name'] !=""){ // If the admin wants to update the immage.
        $img_name = $_FILES['image']['name'];
        $img_path = "/assets/img/$img_name";
        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$img_path);

        $query = "UPDATE bulletin SET description = ?,title = ?, image = ? WHERE bulletin_id = ?";
        $stmt = $cn->prepare($query);
        $stmt->bind_param('sssi', $description, $title, $img_path, $id);
        $stmt->execute();
        $stmt->close();
        $cn->close();
       
    }else { //admin only wants to update the details
            $query = "UPDATE bulletin SET description = ?, title = ? WHERE bulletin_id = ?";
            $stmt = $cn->prepare($query);
            $stmt->bind_param('ssi', $description, $title, $id);
            $stmt->execute();
            $stmt->close();
            $cn->close();
            die(header("Location: ../../views/forms/post.php"));
    }

header("Location: ../../views/forms/post.php");