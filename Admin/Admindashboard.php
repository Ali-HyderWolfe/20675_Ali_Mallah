<?php 
include_once('../HF/header.php');

require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
?>

<div class="container">
    <div class="row">
        <span class="alert alert-warning" role="alert">
            <?php if (isset($_GET['msg'])) {
                echo $_GET['msg'];
            } ?>
        </span>
    </div>

    <div class="row mb-4">
        <div class="col-sm-4">
            <a href="Adminblogs.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">Blogs</h3>
                        <h5 class="card-text">Total Blogs : 20</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-4">
            <a href="posts.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">Total Posts</h3>
                        <h5 class="card-text">Total Posts : 3.6k</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-4">
            <a href="approvals.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">User Approvals</h3>
                        <h5 class="card-text">Pending : 7</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-4">
            <a href="followers.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">Followers</h3>
                        <h5 class="card-text">Total Followers : 150k</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-4">
            <a href="users.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">Edit Users</h3>
                        <h5 class="card-text">Total Users : 19</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-4">
            <a href="active.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">Active Or Inactive</h3>
                        <h5 class="card-text">Click To Proceed</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-4">
            <a href="feedback.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">FeedBacks</h3>
                        <h5 class="card-text">Remaining Feedback's : 6</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-4">
            <a href="categories.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">Categories</h3>
                        <h5 class="card-text">Total Categories : 7</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-4">
            <a href="registerAdmin.php" class="text-decoration-none">
                <div class="card text-bg-light mb-3 me-3">
                    <div class="card-body">
                        <h3 class="card-title">Add User Or Admin</h3>
                        <h5 class="card-text">Click To Proceed</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <hr>

    <!-- Top blogs in cards start -->
    <div class="row mb-4">
        <h3 class="text-dark" style="font-weight: 600;">Your Blogs</h3>
        <?php 
            $query = "SELECT * FROM blog WHERE user_id = '{$_SESSION['data']['user_id']}' AND blog_status = 'Active' LIMIT 0,6";
            $result = $database->execute_query($query);
            
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-sm-4 mb-3">
                <div class="card text-bg-dark">
                    <img style="height: 250px;" src="<?= $row['blog_background_image'] ?>" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title"><?= $row['blog_title'] ?></h5>
                        <a href="../blogdetail.php?blog_id=<?= $row['blog_id'] ?>" class="btn btn-primary">View Blog</a>
                        <p class="card-text"><small>Last updated <?= $row['created_at'] ?></small></p>
                    </div>
                </div>
            </div>
        <?php 
                }
            }
        ?>
    </div>
    <hr>
</div>

<?php 
include_once('../HF/footer.php');
?>
