<?php include_once("partials/menu.php") ?>

<!-- manin-content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br>

        <?php
        session("update-order");
        session("delete");
        ?>

        <!-- button to add admin-->

        <br /><br />

        <table class="full-table">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>price</th>
                <th>QTY</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM `tbl_order`";
            $res = $conn->query($sql);
            $count = mysqli_num_rows($res);
            $counter = 0;
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
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
                    ?>
                    <tr>
                        <td>
                            <?= ++$counter ?>
                        </td>
                        <td>
                            <?= $food ?>
                        </td>
                        <td>
                            <?= $price ?>
                        </td>
                        <td>
                            <?= $qty ?>
                        </td>
                        <td>
                            <?= $total ?>
                        </td>
                        <td>
                            <?= $oreder_data ?>
                        </td>
                        <?php
                        if ($status == "ordered") {
                            ?>

                            <td style="color:blue;  font-weight:bold;">
                                <?= $status ?>
                            </td>
                            <?php
                        } else if ($status == "cancelled") {
                            ?>

                            <td style="color:red;  font-weight:bold;">
                                <?= $status ?>
                            </td>
                            <?php
                        } else if ($status == "on-delivery") {
                            ?>

                            <td style="color:#d1d103; font-weight:bold;">
                                <?= $status ?>
                            </td>
                            <?php

                        } else if ($status == "deliveried") {
                            ?>

                            <td style="color:green;  font-weight:bold;">
                                <?= $status ?>
                            </td>
                            <?php

                        }
                        ?>
                        <td>
                            <?= $customer_name ?>
                        </td>
                        <td>
                            <?= $customer_contact ?>
                        </td>
                        <td>
                            <?= $customer_email ?>
                        </td>
                        <td>
                            <?= $customer_address ?>
                        </td>
                        <td>
                            <a href="<?= SITEURL ?>admin/update-order.php?id=<?= $id ?>" class="btn-secondary link">Update</a>
                        </td>
                    </tr>
                    <?php
                }

            } else {
                ?>
                <tr>
                    <td colspan="12" class="error-text text-center">
                        No data available!!
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>

    </div>
</div>
<!-- manin-content section ends -->

<?php include_once("partials/footer.php") ?>