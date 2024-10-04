<?php 
include_once('../HF/header.php');
require_once("../database_class.php");

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
?>

<!-- table of users to be approval start -->
<div class="container mt-4">
    <div class="alert alert-success" role="alert">
        <?php 
            if (isset($_GET['msg'])) {
                echo $_GET['msg'];
            }
        ?>
    </div>

    <h3 class="text-white text-center" style="font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Pending Approvals</h3>
    <table id="myTable" class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>R no</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Home Town</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $query = "SELECT * FROM user WHERE is_approved = 'Pending'";
                $result = $database->execute_query($query);

                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['first_name']." ".$row['last_name']?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td><?= $row['date_of_birth'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['is_approved'] ?></td>
                <td style="display: flex;">
                    <form action="process.php?action=Approve" method="post" class="me-2">
                        <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                        <input type="hidden" name="is_Approved" value="Approved">
                        <input class="btn btn-success" type="submit" name="submit" value="Approve">
                    </form>
                    <form action="process.php?action=Approve" method="post">
                        <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                        <input type="hidden" name="is_Approved" value="Rejected">
                        <input class="btn btn-danger" type="submit" name="submit" value="Reject">
                    </form>
                </td>
            </tr>
            <?php 
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<!-- table of users to be approval end -->

<?php 
include_once('../HF/footer.php');
?>
