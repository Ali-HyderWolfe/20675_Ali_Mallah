<?php 
include_once('../HF/header.php');

require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
?>
<div class="container mt-5">
    <div class="alert alert-success" role="alert">
        <?php 
        if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        }
        ?>
    </div>

    <h3 class="text-white font-weight-bold text-center mb-4" style="text-shadow: 0 0 7px #0000FF, 0 0 10px red;">
        Comments For Post
    </h3>

    <table id="myTable" class="table table-striped table-bordered">
        <thead class="table-warning">
            <tr>
                <th>User Profile</th>
                <th>User Name</th>
                <th>Comment</th>
                <th>Comment Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($_REQUEST['post_id'])) {
                extract($_REQUEST);

                $query = "SELECT
                    user.first_name,
                    user.last_name,
                    user.user_image,
                    post_comment.comment,
                    post_comment.created_at,
                    post_comment.is_active,
                    post_comment.post_comment_id
                FROM
                    post_comment
                INNER JOIN user 
                    ON post_comment.user_id = user.user_id
                WHERE post_id = '{$post_id}'";

                $result = $database->execute_query($query);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td align="center">
                    <img height="100px" style="border-radius: 50%;" src="../<?= $row['user_image'] ?>" alt="User Image">
                </td>
                <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
                <td><?= $row['comment'] ?></td>
                <td><?= $row['is_active'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <form action="process.php?action=active_comment" method="post">
                        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                        <input type="hidden" name="comment_id" value="<?= $row['post_comment_id'] ?>">
                        <input type="hidden" name="comment_status" value="<?= $row['is_active'] ?>">
                        <button type="submit" class="btn btn-<?= $row['is_active'] == 'Active' ? 'warning' : 'success'; ?>">
                            <?= $row['is_active'] == 'Active' ? 'Deactivate' : 'Activate'; ?>
                        </button>
                    </form>
                </td>
            </tr>
            <?php 
                    }
                } else {
                    echo '<tr><td colspan="6" class="text-center">No comments found for this post.</td></tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php 
include_once('../HF/footer.php');
?>
