<?php
require_once('HF/head.php'); 
require_once "database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Post
    $query = "SELECT * FROM post WHERE post_id = '{$post_id}'";
    $result = $database->execute_query($query);
    $post = mysqli_fetch_assoc($result); 
    $is_comment_allowed = $post['is_comment_allowed'];

    // Categories
    $category_query = "SELECT category_id FROM post_category WHERE post_id = '{$post_id}'";
    $category_result = $database->execute_query($category_query);
    $categories = [];
    if ($category_result && $category_result->num_rows > 0) {
?>

<hr>
<!-- Post Content Start -->
<div class="container bg-light p-4 rounded shadow-sm">
    <div class="row">
        <h3 class="text-primary" style="font-weight: 600;  text-shadow: 0 0 7px black,"><?= $post['post_title'] ?></h3>
        <div class="col-sm-4 mb-3">
            <img src="Admin/<?= $post['featured_image'] ?>" alt="" class="img-fluid rounded"> 
        </div>
        <div class="col-sm-8">
            <h5>Description</h5>
            <p><?= nl2br($post['post_description']) ?></p>

            <h6 class="text-info">Categories:</h6>
            <?php while ($category_row = mysqli_fetch_assoc($category_result)) {
                $category_id = $category_row['category_id'];
                $title_query = "SELECT category_title FROM category WHERE category_id = '{$category_id}'";
                $title_result = $database->execute_query($title_query);
                if ($title_result && $title_result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($title_result)) {
?>
                <span class="badge bg-primary"><?= $row['category_title'] ?></span>
            <?php }  
                } 
            }
            ?>

            <h6 class="text-info mt-2">Attachments:</h6>
            <ul class="list-unstyled">
                <?php  
                $query = "SELECT * FROM post_atachment WHERE post_id = '{$post_id}'"; 
                $result = $database->execute_query($query);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <li>
                        <?php if ($loggedIn) { ?>
                            <a href="Admin/<?= $row['post_attachment_path'] ?>" class="text-decoration-none">
                                <?= $row['post_attachment_title'] ?>
                            </a>
                        <?php } else { ?>
                            <a href="#" style="background-color: red; color:white; padding: 5px; border-radius: 10px;" class="">
                                <?= $row['post_attachment_title'] ?> (Login to download)
                            </a>
                        <?php } ?>
                    </li>
                <?php }
                } ?>
            </ul>
        </div>
    </div>
</div>

<!-- Comments Section -->
<div class="container mt-4 bg-light p-4 rounded shadow-sm">
    <h4 class="text-primary">Comments</h4>
    <div style="max-height: 400px; overflow-y: auto;">
        <div class="row">
            <div class="col-sm-12">
                <div class="comment-section">
                    <?php 
                    $query = "SELECT 
    user.first_name, 
    user.last_name, 
    user.user_image, 
    post_comment.comment, 
    post_comment.created_at
FROM 
    post_comment
INNER JOIN 
    user ON post_comment.user_id = user.user_id
WHERE 
    post_comment.post_id = '{$post_id}'
    AND post_comment.is_active = 'Active'";
                    $result = $database->execute_query($query);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="media bg-light text-dark p-3 mb-3 rounded" style="max-width: 80%; border: 1px solid #ccc;">
                            <img style="width: 50px;" src="<?= $row['user_image'] ?>" alt="user" class="mr-3 rounded-circle">
                            <div class="media-body">
                                <h6 class="mt-0"><?= $row['first_name']." ".$row['last_name'] ?>
                                    <small class="text-success"><?= $row['created_at'] ?></small>
                                </h6>
                                <p><?= nl2br($row['comment']) ?></p>
                            </div>
                        </div>
                    <?php  
                        }
                    } else {
                        echo "<p class='text-muted'>No Comments Available for this Post</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Comment input for logged-in users -->
    <?php if ($loggedIn && $is_comment_allowed == 1) { ?>
        <div class="col-sm-12">
            <div class="input-group mt-3" style="max-width: 80%;">
                <form action="process.php?action=post_comment" method="POST" class="d-flex">
                    <input class="form-control me-2" type="text" name="comment" placeholder="Add Comment..." required>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['data']['user_id'] ?>">
                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                    <input class="btn btn-info" type="submit" name="submit" value="Comment">
                </form>
            </div>
        </div>
    <?php } ?>
</div>

<?php } } ?>
<hr>
<?php require_once('HF/foot.php'); ?>
