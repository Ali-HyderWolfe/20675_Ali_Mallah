<?php 
include_once('../HF/header.php');
require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
?>

<!-- Blogs Start -->
<div class="container mt-4">
    <h3 class="text-dark font-weight-bold mb-4" style="text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Blogs You Created</h3>
    <div class="row">
        <?php 
        $query = "SELECT * FROM blog WHERE user_id = '{$_SESSION['data']['user_id']}' LIMIT 0,4";
        $result = $database->execute_query($query);
        
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-sm-3 mb-3">
            <a href="#" style="text-decoration: none;">
                <div class="card text-bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h3 class="card-title"><?= $row['blog_title']; ?></h3>
                        <h5 class="card-text">Total Posts: 20</h5>
                        <h5 class="card-text">Followers: 20</h5>
                    </div>
                </div>
            </a>
        </div>
        <?php 
            }
        }
        ?>
    </div>
</div>  

<!-- Posts Section Start -->
<hr>
<div class="container">
    <h3 class="text-dark font-weight-bold mb-4" style="text-shadow: 0 0 7px #0000FF, 0 0 10px red;">All Blogs</h3>
    <div class="row">
        <span class="alert alert-warning" role="alert">
            <?php if (isset($_GET['msg'])) {
                echo $_GET['msg'];
            } ?>
        </span>
    </div>
    <table id="myTable" class="table table-striped table-bordered text-center">
        <thead class="table-primary">
            <tr>
                <th>R No</th>
                <th>Blog Name</th>
                <th>Author Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT
                        blog.blog_id,
                        blog.blog_title,
                        user.first_name,
                        user.last_name,
                        blog.blog_status
                      FROM blog
                      INNER JOIN user ON (blog.user_id = user.user_id)";
            $result = $database->execute_query($query);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $row['blog_id']; ?></td>
                <td><?= $row['blog_title']; ?></td>
                <td><?= $row['first_name'] . " " . $row['last_name']; ?></td>
                <td class="<?= $row['blog_status'] == 'Active' ? 'text-success' : 'text-danger' ?>">
                    <?= $row['blog_status']; ?>
                </td>
                <td style="display: flex;">
                    <form action="process.php?action=activeblog" method="post">
                        <input type="hidden" name="blog_id" value="<?= $row['blog_id']; ?>">
                        <input type="hidden" name="status" value="<?= $row['blog_status']; ?>">
                        <button type="submit" class="btn btn-<?= $row['blog_status'] == 'Active' ? 'danger' : 'success' ?>">
                            <?= $row['blog_status'] == 'Active' ? 'Deactivate' : 'Activate'; ?>
                        </button>
                    </form>
                    &nbsp;&nbsp;
                    <form action="updateBlog.php?action=editblog" method="post">
                        <input type="hidden" name="blog_id" value="<?= $row['blog_id']; ?>">
                        <input class="btn btn-warning" type="submit" name="submit" value="Edit Blog">
                    </form>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No blogs found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Blogs End -->
<hr>

<?php 
include_once('../HF/footer.php');
?>
