<?php 
include_once('../HF/header.php');

require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
 ?>



<!-- posts per blog -->

<div class="alert alert-success" role="alert">
        <?php 
        if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        }
        ?>
    </div>





    </div>
</div>  

<!-- posts per blog -->
<hr>
<!-- Posts Section Start -->
<div class="container">
    <h3 style="color: white; font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">All Posts</h3>
    
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Author Name</th>
                <th>Post ID</th>
                <th>Post Title</th>
                <th>Post Category</th>
                <th>Attachments</th>
                <th>Comments Status</th>
                <th>Post Status</th>
                <th>Edit Post</th>
                <th>See Comments</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT * FROM user WHERE user_id = '{$_SESSION['data']['user_id']}'";
            $result = $database->execute_query($query);
            if ($result && $result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $user_id = $row['user_id'];
                $fullname = $row['first_name']." ".$row['last_name'];

                $query = "SELECT * FROM blog WHERE user_id = '{$user_id}' AND blog_status = 'Active'";
                $result = $database->execute_query($query);
                if ($result && $result->num_rows > 0) {
                    $blogs = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $blogs[] = $row['blog_id'];
                        $blog_name = $row['blog_title'];
                    }

                    foreach ($blogs as $blog_id) {
                        $query = "SELECT * FROM post WHERE blog_id = '{$blog_id}'";
                        $result = $database->execute_query($query);
                        if ($result && $result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_status = $row['post_status'];
                                $is_comment_allowed = $row['is_comment_allowed'];

$category_query = "SELECT category_id FROM post_category WHERE post_id = '{$post_id}'";
$category_result = $database->execute_query($category_query);
$categories = [];
if ($category_result && $category_result->num_rows > 0) {
    while ($category_row = mysqli_fetch_assoc($category_result)) {
        $category_id = $category_row['category_id'];

        $title_query = "SELECT category_title FROM category WHERE category_id = '{$category_id}'";
        $title_result = $database->execute_query($title_query);
        if ($title_result && $title_result->num_rows > 0) {
            $title_row = mysqli_fetch_assoc($title_result);
            $categories[] = $title_row['category_title'];
        }
    }
}



                                $attachment_query = "SELECT post_attachment_title, post_attachment_path FROM post_atachment WHERE post_id = '{$post_id}' AND is_active = 'Active'";
                                $attachment_result = $database->execute_query($attachment_query);
                                $attachments = [];
                                if ($attachment_result && $attachment_result->num_rows > 0) {
                                    while ($attachment_row = mysqli_fetch_assoc($attachment_result)) {
                                        $attachments[] = "<a href='{$attachment_row['post_attachment_path']}' target='_blank'>{$attachment_row['post_attachment_title']}</a>";
                                    }
                                }
                                

                               
?>
<tr>
    <td><?= $fullname ?></td>
    <td><?= $post_id ?></td>
    <td><?= $post_title ?></td>
    <td><?php foreach ($categories as $categories) { ?>
        <p style="background-color:green; color:yellow; border-radius: 30px; text-align: center;"><?= $categories ?></p>
 <?php } ?></td>
    <td><?php foreach ($attachments as $attachments) { ?>
        <p style=" border-radius: 30px; text-align: center; background-color: white; "><?= $attachments ?></p>
 <?php } ?></td>
    <td><?= $is_comment_allowed == "1" ? "Allow" : "Not Allow" ?>
                &nbsp;<form action="process.php?action=coment" method="post">
               <input type="hidden" name="comment_status" value="<?= $is_comment_allowed ?>">
               <input type="hidden" name="post_id" value="<?= $post_id ?>">
               <button type="submit" value="<?php if ($is_comment_allowed == "1") {
                           $is_comment_allowed = "Allow";
            }else{
                $is_comment_allowed = "Not Allow";
            } ?>">
                   <?= $is_comment_allowed == 'Allow' ? 'Not Allow' : 'Allow'; ?>
               </button>
           </form>
        

    </td>
    <td> <?= $post_status ?>  
                  <form  action="process.php?action=activepost" method="post">
               <input type="hidden" name="post_id" value="<?= $post_id ?>">
               <input type="hidden" name="status" value="<?= $post_status ?>">
               <button type="submit" value="<?php echo $post_status; ?>">
                   <?= $post_status == 'Active' ? 'InActive' : 'Active'; ?>
               </button>
           </form></td>
    <td>
        <form action='edit_post.php' method='get'>
            <input type='hidden' name='post_id' value='<?= $post_id ?>'>
            <button type='submit' class='btn btn-warning'>Edit</button>
        </form>
    </td>
    <td>
        <form action="post_comments.php" method="POST">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
            <input class="btn btn-info" type="submit" name="submit" value="comments">
        </form>
    </td>
    </tr>
<?php


                            }
                        }
                    }
                } 
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Posts Section End -->


<?php 
include_once('../HF/footer.php');
 ?>
