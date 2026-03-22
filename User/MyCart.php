<?php
ob_start();
include("Head.php");
include("../Asset/Connection/Connection.php");
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
        <style>
            .product-image {
                float: left;
                width: 20%;
            }

            .product-details {
                float: left;
                width: 20%;
            }

            .product-price {
                float: left;
                width: 12%;
            }

            .product-quantity {
                float: left;
                width: 16%;
            }

            .product-removal {
                float: left;
                width: 9%;
            }

            .product-line-price {
                float: left;
                width: 12%;
                text-align: right;
            }

            /* This is used as the traditional .clearfix class */
            .group:before,
            .shopping-cart:before,
            .column-labels:before,
            .product:before,
            .totals-product:before,
            .group:after,
            .shopping-cart:after,
            .column-labels:after,
            .product:after,
            .totals-product:after {
                content: "";
                display: table;
            }

            .group:after,
            .shopping-cart:after,
            .column-labels:after,
            .product:after,
            .totals-product:after {
                clear: both;
            }

            .group,
            .shopping-cart,
            .column-labels,
            .product,
            .totals-product {
                zoom: 1;
            }

            /* Apply clearfix in a few places */
            /* Apply dollar signs */
            .product .product-price:before,
            .product .product-line-price:before,
            .totals-value:before {
                content: "₹";
            }

            /* Body/Header stuff */
            body {
                padding: 0px 30px 30px 20px;
                font-family: "HelveticaNeue-Light", "Helvetica Neue Light",
                    "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-weight: 100;
            }

            h1 {
                font-weight: 100;
            }

            label {
                color: #aaa;
            }

            .shopping-cart {
                margin-top: -45px;
            }

            /* Column headers */
            .column-labels label {
                padding-bottom: 15px;
                margin-bottom: 15px;
                border-bottom: 1px solid #eee;
            }
            .column-labels .product-image,
            .column-labels .product-details,
            .column-labels .product-removal {
                text-indent: -9999px;
            }

            /* product entries */
            .product {
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }
            .product .product-image {
                text-align: center;
            }
            .product .product-image img {
                width: 100px;
            }
            .product .product-details .product-title {
                margin-right: 20px;
                font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
            }
            .product .product-details .product-description {
                margin: 5px 20px 5px 0;
                line-height: 1.4em;
            }
            .product .product-quantity input {
                width: 40px;
            }
            .product .remove-product {
                border: 0;
                padding: 4px 8px;
                background-color: #c66;
                color: #fff;
                font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
                font-size: 12px;
                border-radius: 3px;
            }
            .product .remove-product:hover {
                background-color: #a44;
            }

            /* Totals section */
            .totals .totals-product {
                float: right;
                clear: both;
                width: 100%;
                margin-bottom: 10px;
            }
            .totals .totals-product label {
                float: left;
                clear: both;
                width: 79%;
                text-align: right;
            }
            .totals .totals-product .totals-value {
                float: right;
                width: 21%;
                text-align: right;
            }
            .totals .totals-product-total {
                font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
            }

            .checkout {
                float: right;
                border: 0;
                margin-top: 20px;
                padding: 6px 25px;
                background-color: #6b6;
                color: #fff;
                font-size: 25px;
                border-radius: 3px;
            }

            .checkout:hover {
                background-color: #494;
            }

            /* Make adjustments for tablet */
            @media screen and (max-width: 650px) {
                .shopping-cart {
                    margin: 0;
                    padding-top: 20px;
                    border-top: 1px solid #eee;
                }

                .column-labels {
                    display: none;
                }

                .product-image {
                    float: right;
                    width: auto;
                }
                .product-image img {
                    margin: 0 0 10px 10px;
                }

                .product-details {
                    float: none;
                    margin-bottom: 10px;
                    width: auto;
                }

                .product-price {
                    clear: both;
                    width: 70px;
                }

                .product-quantity {
                    width: 100px;
                }
                .product-quantity input {
                    margin-left: 20px;
                }

                .product-quantity:before {
                    content: "x";
                }

                .product-removal {
                    width: auto;
                }

                .product-line-price {
                    float: left	;
                    width: 70px;
                }
            }
            /* Make more adjustments for phone */
            @media screen and (max-width: 350px) {
                .product-removal {
                    float: right;
                }

                .product-line-price {
                    float: right;
                    clear: left;
                    width: auto;
                    margin-top: 10px;
                }

                .product .product-line-price:before {
                    content: "product Total: ₹";
                }

                .totals .totals-product label {
                    width: 60%;
                }
                .totals .totals-product .totals-value {
                    width: 40%;
                }
            }


            label{
                margin: 0px 15px;
            }



            /*SWITCH 2 ------------------------------------------------*/
            .switch2{
                position: relative;
                display: inline-block;
                width: 60px;
                height: 32px;
                border-radius: 27px;
                background-color: #bdc3c7;
                cursor: pointer;
                transition: all .3s;
            }
            .switch2 input{
                display: none;
            }
            .switch2 input:checked + div{
                left: calc(100% - 40px);
            }
            .switch2 div{
                position: absolute;
                width: 40px;
                height: 40px;
                border-radius: 25px;
                background-color: white;
                top: -4px;
                left: 0px;
                box-shadow: 0px 0px 0.5px 0.5px rgb(170,170,170);
                transition: all .2s;
            }

            .switch2-checked{
                background-color: #2ecc71;
            }


        </style>
    </head>
    <?php
	
        if (isset($_POST["btn_checkout"])) {
                 
                 $amt = $_POST["carttotalamt"];
                $time= $_POST["totime"];
                
                $selC = "select * from tbl_booking where user_id='" .$_SESSION["uid"]. "'and booking_status='0'";
                $rs = $con->query($selC);
                $row=$rs->fetch_assoc();
                
                
                $upQry1 = "update tbl_booking set booking_date=curdate(),booking_amount='".$amt."',booking_status='1' where user_id='" .$_SESSION["uid"]. "' and booking_status=0";
                if($con->query($upQry1))
                {
					$upQry1s = "update tbl_cart set cart_status='1' where booking_id='" .$row["booking_id"]. "'";
					if($con->query($upQry1s))
					{
					  $_SESSION["bid"] = $row["booking_id"];
					  
					  $upQry2="update tbl_booking set delivery_time='".$time."' where booking_id='". $_SESSION["bid"]."'";
					  if($con->query($upQry2)) {
					      // delivery time saved successfully
					  }
					  ?>
					  <script>
						 window.location="Payment.php";
					  </script>
					  <?php
					}
                    
                }
                 
          
        }


    ?>
    <body onload="recalculateCart()">
        <h1>Cart</h1>
            <div class="column-labels">
                <label class="product-price" style="width: 15%; text-align:center">Image</label>
                <label class="product-price" style="width: 16%; text-align:center">Details</label>	
                <label class="product-price" style="width: 10%; text-align:center">Price</label>
                <label class="product-price" style="width: 10%; text-align:center">Qty</label>
                <label class="product-price" style="width: 20%; text-align:center">Remove</label>
                <label class="product-price" style="width: 12%; text-align:center">Total</label>
            </div>
<form method="post">
        <div class="shopping-cart" style="margin-top: 50px">            <?php                
            $sel = "select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id where b.user_id='" .$_SESSION["uid"]. "' and booking_status='0' and cart_status=0";
               $res = $con->query($sel);
                while ($row=$res->fetch_assoc()) {
                    $selPr = "select * from tbl_item where item_id='" .$row["item_id"]. "'";
                    $respr = $con->query($selPr);
                    if ($rowpr=$respr->fetch_assoc()) {
                        $selstock = "select sum(stock_qty) as stock from tbl_stock where item_id='".$rowpr["item_id"]."'";
                        $resst = $con->query($selstock);
                    if ($rowst=$resst->fetch_assoc()) {
            ?>

            <div class="product">
                <div class="product-image">
                    <img
                        src="../Asset/Files/ItemPhoto/<?php echo $rowpr["item_photo"] ?>"
                        />
                </div>
                <div class="product-details">
                    <div class="product-title"><?php echo $rowpr["item_name"] ?></div>
                    <p class="product-description">
                    <?php echo $rowpr["item_details"] ?>
                    </p>
                </div>
                <div class="product-price "	><?php echo $rowpr["item_price"] ?></div>
                <div class="product-quantity">
                    <input alt="<?php echo $row["cart_id"] ?>" type="number" value="<?php echo $row["cart_qty"] ?>" min="1" max="<?php echo $rowst["stock"] ?>"/>
                </div>
                <div class="product-removal">
                    <button class="remove-product" value="<?php echo $row["cart_id"] ?>">Remove</button>
                </div>
                <div class="product-line-price">
                    <?php
                        $pr = $rowpr["item_price"];
                        $qty = $row["cart_qty"];
                        $tot = (int)$pr * (int)$qty;
                        echo $tot;
                    ?>
                </div>
            </div>
            <?php
                    }
                }
              
                }
            ?>

            <div class="totals">
                <div class="totals-product totals-product-total">
                    <label>Grand Total</label>
                    <div class="totals-value" id="cart-total">0</div>
                    <input type="hidden" id="cart-totalamt" name="carttotalamt" value=""/>
                </div>
            </div>
             <div class="column-labels" style="float:right">
                
                    <label>Time for delivery:</label>
                    
                    <input type="time" id="totime"name="totime" readonly/>
            </div>
            <br>
            <br>
            
                <button type="submit" class="checkout"  name="btn_checkout">Checkout</button>
            

        </div>
        <br>
        
</form>
        <!-- partial -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>




var d = new Date(); // for now
console.log(d.getHours());; // => 9
console.log(d.getMinutes()+10);; // =>  30

var time = d.getHours()+":"+(d.getMinutes()+10);

document.getElementById("totime").value=time;


        /* Set rates + misc */
        var fadeTime = 300;

        /* Assign actions */
        $(".product-quantity input").change(function() {
            $.ajax({
                url: "../Asset/AjaxPages/AjaxCart.php?action=Update&id=" + this.alt + "&qty=" + this.value
            });
            updateQuantity(this);

        });

        $(".product-removal button").click(function() {

            $.ajax({
                url: "../Asset/AjaxPages/AjaxCart.php?action=Delete&id=" + this.value
            });
            removeproduct(this);
        });

        /* Recalculate cart */
        function recalculateCart() {
            var subtotal = 0;

            /* Sum up row totals */
            $(".product").each(function() {
                subtotal += parseFloat(
                        $(this).children(".product-line-price").text()
                        );
            });

            /* Calculate totals */
            var total = subtotal;

            /* Update totals display */
            $(".totals-value").fadeOut(fadeTime, function() {
                $("#cart-total").html(total.toFixed(2));
                document.getElementById("cart-totalamt").value = total.toFixed(2);
                if (total == 0) {
                    $(".checkout").fadeOut(fadeTime);
                } else {
                    $(".checkout").fadeIn(fadeTime);
                }
                $(".totals-value").fadeIn(fadeTime);
            });
        }

        /* Update quantity */
        function updateQuantity(quantityInput) {
            /* Calculate line price */
            var productRow = $(quantityInput).parent().parent();
            var price = parseFloat(productRow.children(".product-price").text());
            var quantity = $(quantityInput).val();
            var linePrice = price * quantity;
            /* Update line price display and recalc cart totals */
            productRow.children(".product-line-price").each(function() {
                $(this).fadeOut(fadeTime, function() {
                    $(this).text(linePrice.toFixed(2));
                    recalculateCart();
                    $(this).fadeIn(fadeTime);
                });
            });
        }

        /* Remove product from cart */
        function removeproduct(removeButton) {
            /* Remove row from DOM and recalc cart total */
            var productRow = $(removeButton).parent().parent();
            productRow.slideUp(fadeTime, function() {
                productRow.remove();
                recalculateCart();
            });

        }

        $('.switch2 input').on('change', function() {
            var dad = $(this).parent();
            if ($(this).is(':checked'))
                dad.addClass('switch2-checked');
            else
                dad.removeClass('switch2-checked');
        });
        </script>
    </body>
</html>
<?php
include("Foot.php");
ob_flush();
?>