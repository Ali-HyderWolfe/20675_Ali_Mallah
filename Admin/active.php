<?php include_once('../HF/header.php'); ?>

<?php require_once("../database_class.php");
$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE); ?>

<!-- Active and Inactive Users Section -->
<div class="container mt-4">
    <div class="alert alert-success" role="alert">
        <?php 
        if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        }
        ?>
    </div>

    <h3 class="text-dark font-weight-bold mb-4" style="text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Active or Deactive Users</h3>
    
    <div class="table-responsive">
        <table id="myTable" class="table table-striped table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>R No</th>
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
                $query = "SELECT * FROM user ORDER BY created_at DESC"; 
                $result = $database->execute_query($query);
                if ($result && $result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= $row['user_id']?></td>
                    <td><?= $row['first_name']?></td>
                    <td><?= $row['email']?></td>
                    <td><?= $row['gender']?></td>
                    <td><?= $row['date_of_birth']?></td>
                    <td><?= $row['address']?></td>
                    <td class="<?= $row['is_active'] == 'Active' ? 'text-success' : 'text-danger' ?>">
                        <?= $row['is_active'] ?>
                    </td>
                    <td>
                        <form action="process.php?action=active" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            <input type="hidden" name="status" value="<?php echo $row['is_active']; ?>">
                            <button type="submit" class="btn btn-<?= $row['is_active'] == 'Active' ? 'danger' : 'success' ?>">
                                <?= $row['is_active'] == 'Active' ? 'Deactivate' : 'Activate' ?>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- End Active and Inactive Users Section -->

<?php include_once('../HF/footer.php'); ?>
