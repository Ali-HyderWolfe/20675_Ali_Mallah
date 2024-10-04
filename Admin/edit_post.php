<?php 
include_once('../HF/header.php');

require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);

if (!isset($_GET['post_id'])) {
    echo "Post ID not specified.";
    exit;
}

$post_id = $_GET['post_id'];

$query = "SELECT * FROM post WHERE post_id = '{$post_id}'";
$result = $database->execute_query($query);

if (!$result || $result->num_rows == 0) {
    echo "Post not found.";
    exit;
}

$post = mysqli_fetch_assoc($result);

$query = "SELECT * FROM blog WHERE blog_status = 'Active' AND user_id = '{$_SESSION['data']['user_id']}'";
$result = $database->execute_query($query);
$blogs = [];
if ($result && $result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $blogs[] = $row;
    }
}

$query = "SELECT category_id FROM post_category WHERE post_id = '{$post_id}'";
$result = $database->execute_query($query);
$categories = [];
if ($result && $result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['category_id'];
    }
}

$query = "SELECT * FROM category WHERE category_status = 'Active'";
$result = $database->execute_query($query);
$all_categories = [];
if ($result && $result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $all_categories[] = $row;
    }
}

$query = "SELECT * FROM post_attachment WHERE post_id = '{$post_id}'";
$result = $database->execute_query($query);
$attachments = [];
if ($result && $result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $attachments[] = $row;
    }
}
?>

<!-- Edit Post Form Start -->
<div class="container mt-4">
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-header bg-info text-white text-center">
            <h4>Edit Post</h4>
        </div>
        <div class="card-body bg-light text-dark">
            <form action="process.php?action=editpost" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">

                <div class="mb-3">
                    <label for="postTitle" class="form-label">Post Title</label>
                    <input type="text" class="form-control" name="post_title" value="<?= $post['post_title'] ?>" placeholder="Enter Post Title" required>
                </div>
                <div class="mb-3">
                    <label for="postSummary" class="form-label">Post Summary</label>
                    <textarea class="form-control" name="post_summary" rows="2" placeholder="Enter Post Summary" required><?= $post['post_summary'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="postDescription" class="form-label">Post Description</label>
                    <textarea class="form-control" name="post_description" rows="4" placeholder="Enter Post Description" required><?= $post['post_description'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Select Categories</label>
                    <select class="form-select" name="categories[]" multiple required>
                        <?php foreach ($all_categories as $category) { ?>
                            <option value="<?= $category['category_id'] ?>" <?= in_array($category['category_id'], $categories) ? 'selected' : '' ?>><?= $category['category_title'] ?></option>
                        <?php } ?>
                    </select>
                    <small class="form-text text-info">Hold down the Ctrl (Windows) or Command (Mac) button to select multiple options.</small>
                </div>

                <div class="mb-3">
                    <label for="blogName" class="form-label">Select Blog</label>
                    <select name="blogName" class="form-select" required>
                        <option value="">Select Blog</option>
                        <?php foreach ($blogs as $blog) { ?>
                            <option value="<?= $blog['blog_id'] ?>" <?= $blog['blog_id'] == $post['blog_id'] ? 'selected' : '' ?>><?= $blog['blog_title'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="postImage" class="form-label">Upload Post Image</label>
                    <input class="form-control" type="file" id="postImage" name="post_img" accept="image/*" required>
                    <?php if ($post['featured_image']) { ?>
                        <img src="<?= $post['featured_image'] ?>" alt="Current Image" style="width: 100px; height: auto;" class="mt-2">
                    <?php } ?>
                </div>

                <div class="container mt-4">
                    <div class="mb-3">
                        <label for="postAttachment" class="form-label">Upload Attachments</label>
                        <button type="button" id="add-attachment" class="btn btn-primary btn-sm">Add Attachment</button>
                        <div id="attachment-container" class="mt-3">
                            <?php foreach ($attachments as $attachment) { ?>
                                <div class="mb-2">
                                    <input type="text" name="attachments[]" class="form-control" value="<?= $attachment['post_attachment_title'] ?>" placeholder="Attachment Title" required>
                                    <input type="hidden" name="existing_attachments[]" value="<?= $attachment['post_attachment_id'] ?>">
                                    <input type="file" name="attachment_files[]" class="form-control mt-2" accept="*/*">
                                    <a href="<?= $attachment['post_attachment_path'] ?>" target="_blank" class="text-info">View Existing Attachment</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Users Can Comment on This Post?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="comment" id="inlineRadio1" value="1" <?= $post['is_comment_allowed'] == "1" ? 'checked' : '' ?>>
                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="comment" id="inlineRadio2" value="0" <?= $post['is_comment_allowed'] == "0" ? 'checked' : '' ?>>
                        <label class="form-check-label" for="inlineRadio2">No</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Post Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="post_status" id="inlineRadio3" value="Active" <?= $post['post_status'] == "Active" ? 'checked' : '' ?>>
                        <label class="form-check-label" for="inlineRadio3">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="post_status" id="inlineRadio4" value="InActive" <?= $post['post_status'] == "InActive" ? 'checked' : '' ?>>
                        <label class="form-check-label" for="inlineRadio4">Inactive</label>
                    </div>
                </div>

                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-primary text-white">Update Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Post Form End -->

<?php 
include_once('../HF/footer.php');
?>
