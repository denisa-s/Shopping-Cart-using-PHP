<?php
require_once "ShoppingCart.php";
include("Conectare.php");?>
<HTML>
<HEAD>
    <TITLE>Creare cos cumparaturi </TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="product-grid">
    <strong><strong class="txt-heading"><div class="txt-heading-label">Lista Produse</div></strong></div>
<div align="right"><a href="cos.php">Vezi cosul</a></div>
<div align="left"><a href="Produse_pe_categ.php">Vezi produsele pe categorii</a></div>
    <?php
    $shoppingCart = new ShoppingCart();
    $query = "SELECT * FROM produse";
    $product_array = $shoppingCart->getAllProduct($query);
    if (! empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ?>
            <div class="product-item">
                    <a href="produs.php?id=<?=$product_array[$key]["produsid"];?>">Detalii produs</a></td>
                <form method="post" action="cos.php?action=add&code=<?php echo $product_array[$key]["cod"]; ?>">

                    <div class="product-image">
                        <img src="<?php echo $product_array[$key]["imagine"]; ?>">
                    </div>
                    <div>
                        <strong><?php echo $product_array[$key]["nume"];
                            ?></strong>
                    </div>
                    <div class="product-price"><?php echo "$".$product_array[$key]["pret"]; ?></div>
                    <div>
                        <input type="text" name="quantity" value="1" size="2" />
                        <input type="submit" value="Add to cart"
                               class="btnAddAction" />
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>
</BODY>
</HTML>