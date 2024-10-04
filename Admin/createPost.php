<?php 
include_once('../HF/header.php');
require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
?>

<!-- Create Post Form Start -->
<div class="alert alert-success text-center" role="alert">
    <?php 
    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }
    ?>
</div>

<div class="container">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header bg-info text-white text-center">
            <h4>Create New Post</h4>
        </div>
        <div class="card-body bg-light text-dark">
            <form action="process.php?action=createpost" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="postTitle" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="postTitle" name="postTitle" placeholder="Enter Post Title" required>
                </div>

                <div class="mb-3">
                    <label for="postSummary" class="form-label">Post Summary</label>
                    <textarea class="form-control" id="postSummary" name="postSummary" rows="2" placeholder="Enter Post Summary" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="postDescription" class="form-label">Post Description</label>
                    <textarea class="form-control" id="postDescription" name="postDescription" rows="4" placeholder="Enter Post Description" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Select Categories</label>
                    <select class="form-select" id="category" name="categories[]" multiple required>
                        <?php 
                        $query = "SELECT * FROM category WHERE category_status = 'Active'";
                        $result = $database->execute_query($query);

                        if ($result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"{$row['category_id']}\">{$row['category_title']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <small class="form-text text-info">Hold down the Ctrl (Windows) or Command (Mac) button to select multiple options.</small>
                </div>

                <div class="mb-3">
                    <label for="blogName" class="form-label">Select Blog</label>
                    <select name="blogName" class="form-select" required>
                        <option value="">Select Blog</option>
                        <?php 
                        $query = "SELECT * FROM blog WHERE blog_status = 'Active' AND user_id = '{$_SESSION['data']['user_id']}'";
                        $result = $database->execute_query($query);

                        if ($result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"{$row['blog_id']}\">{$row['blog_title']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="postImage" class="form-label">Upload Post Image</label>
                    <input class="form-control" type="file" id="postImage" name="post_img" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label for="postAttachment" class="form-label">Upload Attachments</label>
                    <button type="button" id="add-attachment" class="btn btn-primary btn-sm">Add Attachment</button>
                    <div id="attachment-container" class="mt-3"></div>
                </div>

                <fieldset class="mb-4">
                    <legend>Allow Comments</legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="comment" id="commentYes" value="1" required>
                        <label class="form-check-label" for="commentYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="comment" id="commentNo" value="0">
                        <label class="form-check-label" for="commentNo">No</label>
                    </div>
                </fieldset>

                <fieldset class="mb-4">
                    <legend>Post Status</legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="post_status" id="statusActive" value="Active" required>
                        <label class="form-check-label" for="statusActive">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="post_status" id="statusInactive" value="InActive">
                        <label class="form-check-label" for="statusInactive">Inactive</label>
                    </div>
                </fieldset>

                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-primary text-white">Create Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Create Post Form End -->

<?php 
include_once('../HF/footer.php');
?>

