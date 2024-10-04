<?php require_once('HF/head.php'); 
require_once "database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);

extract($_REQUEST);

$query = "SELECT * FROM blog WHERE blog_id = '{$blog_id}'";
$result = $database->execute_query($query);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    extract($row);

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $post_per_page;
}

$total_posts_query = "SELECT COUNT(*) as total_posts FROM post WHERE blog_id = '{$blog_id}'";
$total_posts_result = $database->execute_query($total_posts_query);
$total_posts_row = mysqli_fetch_assoc($total_posts_result);
$total_posts = $total_posts_row['total_posts'];

$total_pages = ceil($total_posts / $post_per_page);

$query = "SELECT * FROM post WHERE blog_id = '{$blog_id}' AND post_status = 'Active' LIMIT $post_per_page OFFSET $offset";
$result = $database->execute_query($query);

$user_query = "SELECT * FROM user WHERE user_id = '{$user_id}'";
$user_query_result = $database->execute_query($user_query);
$user = mysqli_fetch_assoc($user_query_result);
?>

<!-- Blog Header -->
<div class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-3">
            <img style="height: 270px;" src="Admin/<?= $blog_background_image ?>" class="img-fluid rounded-circle shadow" alt="Blog Image">
        </div>
        <div class="col-md-9">
            <h1 class="text-dark"><?= $blog_title ?></h1>
            <?php if ($loggedIn) { ?>
                <a href="#" class="btn btn-outline-primary text-dark">Follow</a>
            <?php } ?>
        </div>
    </div>
</div>
<hr class="my-4" style="border-color: royalblue;">

<!-- Posts  -->
<div class="container">
    <h2 class="text-dark mb-4">Posts from this Blog</h2>
    <div class="row">
    <?php 
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <!-- Post Card -->
        <div class="col-md-4 mb-4">
            <div class="card bg-light text-dark h-100 border-primary">
                <img style="height: 350px;" src="Admin/<?= $row['featured_image'] ?>" class="card-img-top" alt="Post Image">
                <div class="card-body">
                    <h5 class="post-title"><?= $row['post_title'] ?></h5>
                    <p class="post-content"><?= $row['post_summary'] ?></p>
                </div>
                <div class="post-details p-3">
                    <span>Author: <?= $user['first_name'] . " " . $user['last_name'] ?></span><br>
                    <span>Blog: <?= $blog_title ?></span>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" onclick="window.location.href='viewpost.php?post_id=<?= $row['post_id'] ?>'">View Post</button>
                </div>
            </div>
        </div>
    <?php 
        }
    } else {
        echo "<h3 class='text-dark'>No Posts On This Blog</h3>";
    }
    ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1) { ?>
        <nav aria-label="Posts navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1){ ?>
                    <li class="page-item">
                        <a class="page-link" href="?blog_id=<?= $blog_id ?>&page=<?= $page - 1 ?>">Previous</a>
                    </li>
                <?php } ?>

                <?php for ($i = 1; $i <= $total_pages; $i++){ ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?blog_id=<?= $blog_id ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php } ?>

                <?php if ($page < $total_pages){ ?>
                    <li class="page-item">
                        <a class="page-link" href="?blog_id=<?= $blog_id ?>&page=<?= $page + 1 ?>">Next</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>
</div>

<?php require_once('HF/foot.php'); ?>
