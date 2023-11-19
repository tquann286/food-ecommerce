<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Displaying Session Message
            unset($_SESSION['add']); //REmoving Session Message
        }
        ?>

        <br><br><br>

        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br /><br /><br />


        <table class="tbl-full">
            <tr>
                <th>Stt</th>
                <th>Họ tên</th>
                <th>Tên người dùng</th>
                <th>Hành động</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                // Count Rows to CHeck whether we have data in database or not
                $count = mysqli_num_rows($res);

                $sn = 1;

                //CHeck the num of rows
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        ?>

                        <tr>
                            <td>
                                <?php echo $sn++; ?>.
                            </td>
                            <td>
                                <?php echo $full_name; ?>
                            </td>
                            <td>
                                <?php echo $username; ?>
                            </td>
                            <td>
                                <a href="#" class="btn-secondary">Update Admin</a>
                                <a href="#" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>

                        <?php

                    }
                } else {
                    // If Do not Have Data in Database
                }
            }

            ?>

        </table>

    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>