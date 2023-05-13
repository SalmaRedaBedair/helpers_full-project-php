<?php
ob_start();

include_once("partials/menu.php") ?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $id = number_validation($conn, $id, "number");
            if (isset($_SESSION['number'])) {
                $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
                header("LOCATION:" . SITEURL . "admin/manage-order.php");
                unset($_SESSION['number']);
                exit();
            }
            $sql = "SELECT * FROM `tbl_order` WHERE `id`=$id";
            $res = $conn->query($sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $oreder_data = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
            }

        } else {
            $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
            header('LOCATION:' . SITEURL . 'admin/manage-order.php');
            exit();
        }

        ?>

        <br /><br />

        <form action="" method="POST" autocomplete="on">
            <table class="tbl-30">
                <tr>
                    <td>Food: </td>
                    <td>
                        <?=$food?>
                        <?php
                        message("Food");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        $<?=$price?>
                        <?php
                        message("Price");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>QTY: </td>
                    <td>
                        <input type="number" value="<?=$qty?>" name="qty">
                        <?php
                        message("Qty");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option value="ordered">Ordered</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="on-delivery">On Delivery</option>
                            <option value="deliveried">Deliveried</option>
                            <?php
                        message("Status");
                        ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" value="<?=$customer_name?>" name="customer_name">
                        <?php
                        message("Customer-name");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="phone" value="<?=$customer_contact?>" name="customer_contact">
                        <?php
                        message("phone");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="email" value="<?=$customer_email?>" name="customer_email">
                        <?php
                        message("email");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <input type="text" value="<?=$customer_address?>" name="customer_address">
                        <?php
                        message("Address");
                        ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="hidden" name="food" value="<?= $food ?>">
                        <input type="hidden" name="price" value="<?= $price ?>">
                        <input type="submit" class="btn-secondary" value="Update Food" name="submit">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<!-- manin-content section ends -->


<?php
if (isset($_POST['submit'])) {
    $food_id=$_POST['id'];
    $food=$_POST['food'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];
    $status=$_POST['status'];
    $customer_name=$_POST['customer_name'];
    $customer_contact=$_POST['customer_contact'];
    $customer_email=$_POST['customer_email'];
    $customer_address=$_POST['customer_address'];

    $food_id=number_validation($conn,$food_id,"Food-id");
    $food=string_validation($conn,$food,"Food");
    $price=number_validation($conn,$price,"Price");
    $qty=number_validation($conn,$qty,"Qty");
    $status=string_validation($conn,$status,"Status");
    $customer_name=string_validation($conn,$customer_name,"Customer-name");
    $customer_contact=phone_validation($conn,$customer_contact);
    $customer_email=email_validation($conn,$customer_email);
    $customer_address=string_validation($conn,$customer_address,"Addrees");

    if(isset($_SESSION['Food-id'])){
        unset($_SESSION['Food-id']);
        header('LOCATION:'.SITEURL.'admin/manage-order.php');
        exit();
    }
    else if(isset($_SESSION['Food'])||isset($_SESSION['Price'])||isset($_SESSION['Qty'])||isset($_SESSION['Status'])||isset($_SESSION['Customer-name'])||isset($_SESSION['phone'])||isset($_SESSION['email'])||isset($_SESSION['Address'])){
        header('LOCATION:'.SITEURL."admin/update-order.php?id=$food_id");
        exit();
    }

    $total=$price*$qty;
    $sql2="UPDATE `tbl_order` SET
    `qty`='$qty',
    `total`='$total',
    `status`='$status',
    `customer_name`='$customer_name',
    `customer_contact`='$customer_contact',
    `customer_email`='$customer_email',
    `customer_address`='$customer_address'
    where `id`=$food_id;
    ";
    $res2=$conn->query($sql2);
    if($res2==true)
    {
        $_SESSION['delete'] = "<div class='error'>Unauthorized access!</div>";
        $_SESSION['update-order']="<div class='success'>Order updated successfully.</div>";
        header('LOCATION:'.SITEURL.'admin/manage-order.php');
    }else{
        $_SESSION['update-order']="<div class='error'>Failed to update order!!.</div>";
        header('LOCATION:'.SITEURL.'admin/manage-order.php');
    }
}
?>



<?php include_once("partials/footer.php");
ob_end_flush();
// i add buffer to ensure that no output is sent to the browser until it is ready to be sent.
?>