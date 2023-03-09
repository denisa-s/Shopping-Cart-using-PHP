<?php
require_once "DBController.php";
class ShoppingCart extends DBController
{
    function getAllProduct()
    {
        $query = "SELECT * FROM produse";
        $productResult = $this->getDBResult($query);
        return $productResult;
    }
    function getMemberCartItem($member_id)
    {
        $query = "SELECT produse.*, cos.id as cart_id,cos.cantitate FROM produse, cos WHERE produse.produsid = cos.produsID AND cos.clientID = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }
    function getProductByCode($product_code)
    {
        $query = "SELECT * FROM produse WHERE cod=?";
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $product_code
            )
        );
        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }
    /*function getProductByCategory($productcat)
    {
        $query = "SELECT * FROM produse WHERE categorie=?";
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $productcat
            )
        );
        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }*/
    function getCartItemByProduct($product_id, $member_id)
    {
        $query = "SELECT * FROM cos WHERE produsID = ? AND clientID = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }
    function addToCart($product_id, $quantity, $member_id)
    {
        $query = "INSERT INTO cos (produsID,cantitate,clientID)VALUES (?, ?, ?)";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        $this->updateDB($query, $params);
    }
    function updateCartQuantity($quantity, $cart_id)
    {
        $query = "UPDATE cos SET cantitate = ? WHERE id= ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        $this->updateDB($query, $params);
    }
    function deleteCartItem($cart_id)
    {
        $query = "DELETE FROM cos WHERE id = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        $this->updateDB($query, $params);
    }
    function emptyCart($member_id)
    {
        $query = "DELETE FROM cos WHERE clientID = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        $this->updateDB($query, $params);
    }
}
