<?php
    include("header.php");
    require("common.inc.php");
    $db = getDB();
    if (isset($_POST["userId"]) && isset($_POST["productId"]) && isset($_POST["purchaseQuantity"]) && isset($_POST["price"])) {
        try {
            $userId = $_POST["userId"];
            $productId = $_POST["productId"];
            $quantity = $_POST["purchaseQuantity"];
            $price = $_POST["price"];
            $stmt = $db->prepare("INSERT INTO Carts(userId, productId, quantity, price) VALUES (:userId, :productId, :quantity, :price)");
            $result = $stmt->execute(array(
                ":userId" => $userId,
                ":productId" => $productId,
                ":quantity" => $quantity,
                ":price" => $price
            ));
            $e = $stmt->errorInfo();
            if ($e[0] != "00000") {
                echo var_export($e, true);
            }
            else {
                echo var_export($result, true);
                if ($result) {
                    echo "Successfully added to cart!";
                } else {
                    echo "Error while adding to cart";
                }
            }
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
?>