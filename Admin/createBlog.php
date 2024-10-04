<?php 
include_once('../HF/header.php');
?>
<div class="alert alert-success text-center" role="alert">
    <?php 
    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }
    ?>
</div>
<!-- Create Blog Form Start -->
<div class="container">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header bg-danger text-white text-center">
            <h4>Create New Blog</h4>
        </div>
        <div class="card-body bg-light text-dark">
            <form action="process.php?action=createblog" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="blog-name" class="form-label">Blog Name</label>
                    <input type="text" class="form-control" id="blog-name" name="blog_name" placeholder="Enter Blog Name" required>
                </div>
                <div class="mb-3">
                    <label for="post_per_page" class="form-label">Posts Per Page</label>
                    <input type="number" class="form-control" id="post_per_page" name="post_per_page" value="4" min="3" max="10" step="1" required>
                </div>
                <div class="mb-3">
                    <label for="blog_image" class="form-label">Upload Blog Image</label>
                    <input class="form-control" type="file" id="blog_image" name="blog_image" accept="image/*" required>
                </div>
                <input type="hidden" name="admin_id" value="<?= $_SESSION['data']['user_id'] ?>">
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-primary text-white">Create Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Create Blog Form End -->

<?php 
include_once('../HF/footer.php');
?>
