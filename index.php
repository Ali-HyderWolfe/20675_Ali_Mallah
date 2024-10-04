<?php 
require_once('HF/head.php');
require_once "database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);

?>

<!-- Content Start -->

<div class="container">
    <?php if ($loggedIn){ ?>
        <!-- User details and news feed -->
        <div class="alert alert-success" role="alert">
             <?php 
                if (isset($_GET['msg'])) {
                    echo $_GET['msg'];
                }
              ?>
        </div>

        <div class="row justify-content-end">
            <div class="col-sm-3 text-center">
                <h3><?= $_SESSION['data']['first_name']." ".$_SESSION['data']['last_name'];?></h3>
                <a href="#"><img class="dpimage rounded-circle border" src="<?= $_SESSION['data']['user_image'];?>" style="width:100px; height: 100px;" alt="Profile Image"></a>
            </div>
        </div>

        <!-- Blog Display -->
        <div class="row my-5">
            <h3 class="text-white text-center" style="font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Blogs</h3>
            <?php 
                $query = "SELECT * FROM blog ";
                $blogResult = $database->execute_query($query);

                if ($blogResult->num_rows > 0) {
                    while ($blogRow = mysqli_fetch_assoc($blogResult)) {
            ?>
            <div class="col-sm-4 mb-4">
                <div class="card border-0 shadow-lg bg-dark text-white h-100">
                    <img style="height: 250px; object-fit: cover;" src="Admin/<?= $blogRow['blog_background_image'] ?>" class="card-img-top" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $blogRow['blog_title'] ?></h5>
                        <p class="card-text"><small><?= $blogRow['created_at'] ?></small></p>
                        <a href="blogdetail.php?blog_id=<?= $blogRow['blog_id'] ?>" class="btn btn-primary">View Blog</a>
                        <a href="#" class="btn btn-outline-light">Follow</a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>  

        <!-- Post Display -->
        <div class="row my-5">
            <h3 class="text-white text-center" style="font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Latest Posts</h3>
            <?php 
                $query = "SELECT * FROM post WHERE post_status = 'Active' LIMIT 20";
                $postResult = $database->execute_query($query);

                if ($postResult->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($postResult)) {
                         $post_id  = $row['post_id'];
            ?>
            <div class="col-sm-3 mb-4">
                <div class="card postcard bg-dark text-white shadow-lg" style="width: 18rem;">
                    <img src="Admin/<?= $row['featured_image'] ?>" class="card-img-top" alt="Post Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['post_title'] ?></h5>
                        <p class="card-text"><?= $row['post_summary'] ?></p>
                        <a href="viewpost.php?post_id=<?= $post_id ?>" class="btn btn-info">View Post</a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    <?php } else { ?>
        <!-- Display for Non-Logged-In Users -->
        <div class="container text-center my-5">
            <div class="alert alert-success" role="alert">
                <?php 
                    if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }
                ?>
            </div>
            <h1 class="text-dark">Welcome to Marvel Blog</h1>
            <p class="text-white">Please <a href="login.php" class="btn btn-primary">Login</a> or <a href="register.php" class="btn btn-primary">Register</a></p>
        </div>

        <!-- Blog Display for Non-Logged-In Users -->
        <div class="row my-5">
            <h3 class="text-white text-center" style="font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Latest Blogs</h3>
            <?php 
                $query = "SELECT * FROM blog LIMIT 6";
                $blogResult = $database->execute_query($query);

                if ($blogResult->num_rows > 0) {
                    while ($blogRow = mysqli_fetch_assoc($blogResult)) {
            ?>
            <div class="col-sm-4 mb-4">
                <div class="card bg-dark text-white shadow-lg">
                    <img style="height: 250px; object-fit: cover;" src="Admin/<?= $blogRow['blog_background_image'] ?>" class="card-img-top" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $blogRow['blog_title'] ?></h5>
                        <p class="card-text"><?= $blogRow['created_at'] ?></p>
                        <a href="blogdetail.php?blog_id=<?= $blogRow['blog_id'] ?>" class="btn btn-primary">View Blog</a>
                        <a href="#" onclick="Follow()" class="btn btn-outline-light">Follow</a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div> 

        <!-- Post Display for Non-Logged-In Users -->
        <div class="row my-5">
            <h3 class="text-white text-center" style="font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Latest Posts</h3>
            <?php 
                $query = "SELECT * FROM post WHERE post_status = 'Active' LIMIT 8";
                $postResult = $database->execute_query($query);

                if ($postResult->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($postResult)) {
            ?>
            <div class="col-sm-3 mb-4">
                <div class="card postcard bg-dark text-white " style="width: 18rem;">
                    <img src="Admin/<?= $row['featured_image'] ?>" class="card-img-top" alt="Post Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['post_title'] ?></h5>
                        <p class="card-text"><?= $row['post_summary'] ?></p>
                        <a href="viewpost.php?post_id=<?= $row['post_id'] ?>" class="btn btn-info">View Post</a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    <?php } ?>

    <!-- Our Bloggers Section -->
    <div class="row my-5">
        <h3 class="text-white text-center" style="font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Our Bloggers</h3>
        <?php 
            $query = "SELECT * FROM user WHERE role_id = '1' LIMIT 4";
            $Result = $database->execute_query($query);

            if ($Result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($Result)) {
        ?>
        <div class="col-sm-3 mb-4">
            <div class="card shadow-lg" style="width: 18rem;">
                <img style="height: 300px;" src="<?= $row['user_image'] ?>" class="card-img-top" alt="User Image">
                <div class="card-body bg-light text-black">
                    <h5 class="card-title"><b><?= $row['first_name']." ".$row['last_name'] ?></b></h5>
                    <h6>Administrator & Blogger</h6>
                    <p class="card-text">Joined: <?= $row['created_at'] ?></p>
                </div>
            </div>
        </div>
        <?php } } ?>
    </div>

    <!-- About Us And Feedback Section -->
    <section id="about" class="py-5 text-center">
        <div class="container">
            <h2>About Us</h2>
            <p>The Marvel Blog represents the latest news, technology, and more from around the world.</p>
        </div>
    </section>

    <section id="Feedback" class="py-5 bg-light text-center">
        <div class="container">
            <h2>Feedback</h2>
            <?php if ($loggedIn) { ?>
                <form method="post" action="process.php?action=feedbackuser">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['data']['user_id']; ?>">
                    <input class="btn btn-info" type="submit" name="submit" value="Submit Feedback">
                </form>
            <?php } else { ?>
                <form method="post" action="process.php?action=feedback">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <input class="btn btn-info" type="submit" name="submit" value="Submit Feedback">
                </form>
            <?php } ?>
        </div>
    </section>
</div>
<!-- Content End -->

<script>
    function Follow(){
        alert('Please login or register to follow.');
    }
</script>

<?php require_once('HF/foot.php'); ?> 
