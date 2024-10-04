<?php 
include_once('../HF/header.php');

require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
?>

<!-- Feedback Section Start -->

<div class="container mt-5">
    <div class="alert alert-success" role="alert">
        <?php 
        if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        }
        ?>
    </div>

    <h3 class="text-white font-weight-bold text-center" style="text-shadow: 0 0 7px #0000FF, 0 0 10px red;">
        Feedbacks
    </h3>

    <table id="myTable" class="table table-striped table-bordered mt-4">
        <thead class="table-warning">
            <tr>
                <th>Feedback ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Feedback</th>
                <th>Received On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT * FROM user_feedback";
            $result = $database->execute_query($query);

            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $row['feedback_id']; ?></td>
                <td><?php if ($row['user_id'] == "") {
                    echo "Guest";
                }else{
                    echo "User";
                } ?></td>
                <td><?= $row['user_name']; ?></td>
                <td><?= $row['user_email']; ?></td>
                <td><?= $row['feedback']; ?></td>
                <td><?= $row['created_at']; ?></td>
                <td>
                    <form action="process.php?action=deletefeedback" method="POST">
                        <input type="hidden" name="feedback_id" value="<?= $row['feedback_id']; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo '<tr><td colspan="7" class="text-center">No feedback available.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Feedback Section End -->

<?php 
include_once('../HF/footer.php');
?>
