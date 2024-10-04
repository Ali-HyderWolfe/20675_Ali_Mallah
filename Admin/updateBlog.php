<?php  
require_once('../HF/header.php');
require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
extract($_REQUEST);
$query = "SELECT * FROM blog WHERE blog_id = '{$blog_id}'";
$result  = $database->execute_query($query);

if ($result->num_rows > 0) {
    $row['variables'] = mysqli_fetch_assoc($result);
}
?>
<div class="container">
    <div class="card" style="width: 500px;">
        <div class="card-header bg-warning text-white">
            <h4>Update Blog</h4>
        </div>
        <div class="card-body bg-light">
            <form action="process.php?action=updateblog" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="blogName" class="form-label">Blog Name</label>
                    <input type="text" class="form-control" id="blog-name" name="blog_name" value="<?= $row['variables']['blog_title']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="blogName" class="form-label">Posts Per Page</label>
                    <input type="number" name="post_per_page" class="form-control" value="<?= $row['variables']['post_per_page']; ?>" min="3" max="10" step="1" required/>
                </div>
                <div class="mb-3">
                    <label for="blogImage" class="form-label">Upload Blog Image</label>
                    <input class="form-control" type="file" id="blog_image" name="blog_image" accept="image/*" value="<?= $row['variables']['blog_background_image'] ?>" required>
                    <?php if (!empty($row['variables']['blog_background_image'])) { ?>
                        <small class="form-text text-warning">Current image: <img style="width: 120px" src="blog_bg/<?= basename($row['variables']['blog_background_image']); ?>" alt=""></small>
                    <?php } ?>
                </div>
                <input type="hidden" name="blog_id" value="<?= $row['variables']['blog_id']; ?>">
                <input type="hidden" name="admin_id" value="<?= $_SESSION['data']['user_id'] ?>">
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('../HF/footer.php'); ?>
