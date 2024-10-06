<?php

require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";
require "../PHPMailer/src/Exception.php";

date_default_timezone_set("asia/karachi");
$created_at = date("Y-m-d H:i:s");
$updated_at = $created_at;
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
echo "<pre>";
print_r($_FILES);
echo "</pre>";
// isset($_REQUEST);
// isset($_FILES);


extract($_REQUEST);

if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "active") {
    $status = $_POST["status"] == "Active" ? "InActive" : "Active";
    $status_text = $status == "Active" ? "InActive" : "Active";

    $query = "UPDATE user SET is_active = '{$status}' WHERE user_id = '{$user_id}'";

    $result = $database->execute_query($query);

    $query = "SELECT * FROM user WHERE user_id = '{$user_id}'";

    $result = $database->execute_query($query);

    $row["status"] = mysqli_fetch_assoc($result);

    if ($row["status"]["is_active"] == "InActive") {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = "alihydermallah234@gmail.com";
        $mail->Password = "gnqpuzebsjxffxwc";

        $mail->setFrom("abc@gmail.com", "MARVEL BLOG");
        $mail->addReplyTo("alihydermallah234@gmail.com", "MARVEL BLOG");

        $mail->addAddress($row["status"]["email"]);

        $mail->Subject = "Account DeActivated";
        $mail->isHTML(true);
        $mail->Body =
            "<h4><b>Your Account Is Deactivated By Marvel Blog Admin Temporary When Your Account Is Acitve We Will Inform You Through Email Thanku</b></h4>";

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        header("location:active.php?msg=Account InActive Successfully");
    } elseif ($row["status"]["is_active"] == "Active") {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = "alihydermallah234@gmail.com";
        $mail->Password = "gnqpuzebsjxffxwc";

        $mail->setFrom("abc@gmail.com", "MARVEL BLOG");
        $mail->addReplyTo("alihydermallah234@gmail.com", "MARVEL BLOG");

        $mail->addAddress($row["status"]["email"]);

        $mail->Subject = "Account Activated";
        $mail->isHTML(true);
        $mail->Body =
            "<h4><b>Your Account Is Activated By MARVEL Blog You Can Free Roam Now Our Next Level Blog Thank You</b></h4>";

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        header("location:active.php?msg=Account Active Successfully");
    }
}

if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "Approve") {
    if (
        isset($_REQUEST["is_Approved"]) &&
        $_REQUEST["is_Approved"] == "Approved"
    ) {
        $query = "UPDATE user SET is_approved = '{$is_Approved}' WHERE  user_id = '{$user_id}'";

        $result = $database->execute_query($query);
        $query = "SELECT * FROM user WHERE  user_id = '{$user_id}'";

        $result = $database->execute_query($query);

        $row["apr"] = mysqli_fetch_assoc($result);

        if ($row["apr"]["is_approved"] == "Approved") {
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = "alihydermallah234@gmail.com";
            $mail->Password = "gnqpuzebsjxffxwc";

            $mail->setFrom("abc@gmail.com", "MARVEL BLOG");
            $mail->addReplyTo("alihydermallah234@gmail.com", "MARVEL BLOG");

            $mail->addAddress($row["apr"]["email"]);

            $mail->Subject = "Account Approved";
            $mail->isHTML(true);
            $mail->Body =
                "<h4><b>Your Account Is Approved By Marvel Blog you Can Visit Our Blog Now Thank You</b></h4>";

            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            header("location:approvals.php?msg=Account Approved Successfully");
        }
    } elseif (
        isset($_REQUEST["is_Approved"]) &&
        $_REQUEST["is_Approved"] == "Rejected"
    ) {
        $query = "UPDATE user SET is_approved = '{$is_Approved}' WHERE  user_id = '{$user_id}'";

        $result = $database->execute_query($query);
        $query = "SELECT * FROM user WHERE  user_id = '{$user_id}'";

        $result = $database->execute_query($query);

        $row["apr"] = mysqli_fetch_assoc($result);

        if ($row["apr"]["is_approved"] == "Rejected") {
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = "alihydermallah234@gmail.com";
            $mail->Password = "gnqpuzebsjxffxwc";

            $mail->setFrom("abc@gmail.com", "MARVEL BLOG");
            $mail->addReplyTo("alihydermallah234@gmail.com", "MARVEL BLOG");

            $mail->addAddress($row["apr"]["email"]);

            $mail->Subject = "Account Rejected";
            $mail->isHTML(true);
            $mail->Body =
                "<h4><b>Your Account Is Rejected By Marvel Blog You Can Wait 24 Hours Admin Can Approve you Within 24 Hours After 24 hours If Your Account Is Not Approved You Can Create new Account Sorry For Your In convieniance</b></h4>";

            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            header(
                "location:approvals.php?msg=Account Rejected Successfully You Can Approve this Account Within 24 Hours After 24 Hours You Are Not be Abel To Change This User Status",
            );
        }
    }
}
     

     if (isset($_REQUEST['action']) && $_REQUEST['action'] == "edit") {
         
         $query = "UPDATE user SET first_name = '{$firstname}',last_name = '{$lastname}'
         ,gender = '{$gender}', date_of_birth = '{$date_of_birth}',address = '{$address}' WHERE user_id = '{$user_id}'";

         $result = $database->execute_query($query);
         if ($result) {
             header('location:users.php?msg=User Data Updated Seccessfully');
         }else{
            header('location:edituser.php?msg=Something Went Wrong');
         }
     }

     if (isset($_REQUEST['action']) && $_REQUEST['action'] == "categorie" ) {
           $status = "InActive";
          $query = " INSERT INTO category (category_title,category_description,category_status,created_at,updated_at)
          VALUES ('{$title}','{$description}','{$status}','{$created_at}','{$updated_at}')";
          $result = $database->execute_query($query);
          if ($result) {
              header('location:Categories.php?msg=categorie Add Successfully');
          }else{
            header('location:Categories.php?msg=categorie Not Added Something Went Wrong');
          }
     }
     if (isset($_REQUEST['action']) && $_REQUEST['action'] == "categoryactive") {
          $category_status = $_POST["category_status"] == "Active" ? "InActive" : "Active";
          $status_text = $category_status == "Active" ? "InActive" : "Active";

    $query = "UPDATE category SET updated_at ='{$updated_at}',category_status = '{$category_status}' WHERE category_id = '{$category_id}'";

        $result = $database->execute_query($query);

        if ($result) {
            header('location:Categories.php?msg=Categorie Status Has Been Changed Successfully');
        }else{
            header('location:Categories.php?msg=Something Went Wrong Try Again');
        }

     }

     if (isset($_REQUEST['action']) && $_REQUEST['action'] == "deletecategory") {
         $query = "DELETE FROM  category WHERE category_id = '{$category_id}'";

         $result = $database->execute_query($query);

         if ($result) {
             header('location:Categories.php?msg=Categorie Status Has Been Deleted Successfully');
         }else{
            header('location:Categories.php?msg=Something Went Wrong');
         }
     }

     if (isset($_REQUEST['action']) && $_REQUEST['action'] == "deletefeedback") {
        
         $query = "DELETE FROM user_feedback WHERE feedback_id = '{$feedback_id}'";

         $result = $database->execute_query($query);
         if ($result) {
             header('location:feedback.php?msg=feedback deleted Successfully');
         }else{
            header('location:feedback.php?msg=Something Went Wrong');
         }
     }


     if (isset($_REQUEST['action']) && $_REQUEST['action'] == "createblog") {

        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        $uploaddir = "blog_bg/";
        $uploadfile = $uploaddir . basename($_FILES["blog_image"]["name"]);

    if (isset($_FILES["blog_image"]) && $_FILES["blog_image"]["error"] == 0) {
        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $uploadfile)) {
            echo "background uploaded Successfully";
        }
    }
         $blog_status = "Active";
         $query = "INSERT INTO blog (user_id,blog_title,post_per_page,blog_background_image,blog_status,created_at)
         VALUES ('{$admin_id}','{$blog_name}','{$post_per_page}','{$uploadfile}','{$blog_status}','{$created_at}')";

         $result = $database->execute_query($query);
         if ($result) {
             header('location:createBlog.php?msg=Blog Created Successfully');
         }else{
            header('location:createBlog.php?msg=Something Went Wrong Try Again');
         }
     }


     if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "activeblog") {
    $blog_status = $_POST["status"] == "Active" ? "InActive" : "Active";
    $status_text = $blog_status == "Active" ? "InActive" : "Active";

    $query = "UPDATE blog SET blog_status = '{$blog_status}' WHERE blog_id = '{$blog_id}'";

    $result = $database->execute_query($query);

    if ($result) {
        header('location:Adminblogs.php?msg=Blog Status Changed');
    }

}

    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "updateblog") {
        
        
          $uploaddir = "blog_bg/";
    $uploadfile = $uploaddir . basename($_FILES["blog_image"]["name"]);

    if (isset($_FILES["blog_image"]) && $_FILES["blog_image"]["error"] == 0) {
        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $uploadfile)) {
            echo "image uploaded Successfully";
        }
        $query = "UPDATE blog SET blog_title = '{$blog_name}', post_per_page = '{$post_per_page}', blog_background_image = '{$uploadfile}' WHERE blog_id = '{$blog_id}' ";
        $result = $database->execute_query($query);
        if ($result) {
           header('location:Adminblogs.php?msg=Your Blog Is Updated Successfully');
        }else{
            header('location:Adminblogs.php?msg=Your Blog is Not Updated Try Again After while');
        }
    }
    }

    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "createpost") {
    
    $uploaddir = "post_img/";
    $uploadfile = $uploaddir . basename($_FILES["post_img"]["name"]);

    if (isset($_FILES["post_img"]) && $_FILES["post_img"]["error"] == 0) {
        if (move_uploaded_file($_FILES["post_img"]["tmp_name"], $uploadfile)) {
            echo "Image uploaded successfully.";
        }
    }

    $query = "INSERT INTO post (blog_id, post_title, post_summary, post_description, featured_image, post_status, is_comment_allowed, created_at) 
              VALUES ('{$blogName}', '{$postTitle}', '{$postSummary}', '{$postDescription}', '{$uploadfile}', '{$post_status}', '{$comment}', '{$created_at}')";
    
    $result = $database->execute_query($query);
    
    $connection = $database->get_connection();
    $post_id = $connection->insert_id;

    if ($result) {
        foreach ($categories as $key => $value) {
            $query = "INSERT INTO post_category (post_id, category_id, created_at)
                      VALUES ('{$post_id}', '{$value}', '{$created_at}')";
            $database->execute_query($query);
        }

        if (isset($_FILES['attachment_files'])) {
            $attachmentDir = "post_attachments/";
            foreach ($_FILES['attachment_files']['name'] as $index => $filename) {
                // Skip if there's no file
                if ($_FILES['attachment_files']['error'][$index] != 0) {
                    continue;
                }

                $attachmentPath = $attachmentDir . basename($filename);
                if (move_uploaded_file($_FILES['attachment_files']['tmp_name'][$index], $attachmentPath)) {
                    $attachmentTitle = $_POST['attachment_titles'][$index];

                    $query = "INSERT INTO post_atachment (post_id, post_attachment_title, post_attachment_path, is_active, created_at) 
                              VALUES ('{$post_id}', '{$attachmentTitle}', '{$attachmentPath}', 'Active', '{$created_at}')";
                    $database->execute_query($query);
                }
            }
        }

        header('location:createPost.php?msg=Post Added Successfully');
    } else {
        header('location:createPost.php?msg=Post Was Not Added Properly. Try Again.');
    }
}

    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "coment") {
        
        $comment_status = $_POST["comment_status"] == "1" ? "0" : "1";
        echo $comment_status;
        $query = "UPDATE post SET is_comment_allowed = '{$comment_status}' WHERE post_id ='{$post_id}'";
        $result = $database->execute_query($query);

        if ($result) {
           header('location:posts.php?msg=Post Comment Status Changed Successfully');
        }else{
            header('location:posts.php?msg=Post Comment Status Not Changed Something Went Wrong try Again');
        }
    }


    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "activepost") {
          $post_status = $_POST["status"] == "Active" ? "InActive" : "Active";
         
         $query = "UPDATE post SET post_status = '{$post_status}' WHERE post_id = '{$post_id}'";

         $result = $database->execute_query($query);

         if ($result) {
             header('location:posts.php?msg=Post Status Has Been Changed Successfully');
         }else{
            header('location:posts.php?msg=Post Status Not Changed Something Went Wrong');
         }

      }  

      if (isset($_REQUEST['action']) && $_REQUEST['action'] == "updateadmin") {
           $uploaddir = "uploads/";
           $uploadfile = $uploaddir . basename($_FILES["user_image"]["name"]);

    if (isset($_FILES["user_image"]) && $_FILES["user_image"]["error"] == 0) {
        if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $uploadfile)) {
            echo "image uploaded Successfully";
        }
    }

         $query = "UPDATE user SET first_name = '{$first_name}',last_name = '{$last_name}',email = '{$email}', password = '{$password}',gender = '{$gender}',date_of_birth = '{$date_of_birth}',user_image = '{$uploadfile}',address = '{$address}',updated_at = '{$updated_at}' WHERE user_id = '{$user_id}'";

         $result = $database->execute_query($query);
         if ($result) {
             header('location:Admindashboard.php?msg=Your Record updated Successfully');
         }else{
            header('location:Admindashboard.php?msg=Your Record Not Updated Something Went Wrong Try Again After While');
         }
      }


      if (isset($_REQUEST['action']) && $_REQUEST['action'] == "editpost") {
       
       $uploaddir = "post_img/";
    $uploadfile = $uploaddir . basename($_FILES["post_img"]["name"]);

    if (isset($_FILES["post_img"]) && $_FILES["post_img"]["error"] == 0) {
        if (move_uploaded_file($_FILES["post_img"]["tmp_name"], $uploadfile)) {
            echo "Image uploaded successfully.";
        }
    }
     $query = "UPDATE post SET post_title = '{$post_title}',post_summary = '{$post_summary}',
     post_description = '{$post_description}',featured_image = '{$uploadfile}' WHERE post_id = '{$post_id}'";

     $result = $database->execute_query($query);
     if ($result) {
        $query = "DELETE FROM post_category WHERE post_id = '{$post_id}'";
          $result  =  $database->execute_query($query);

         foreach ($categories as $key => $value) {
              
              $query = "INSERT INTO post_category (post_id,category_id,updated_at)
              VALUES ('{$post_id}','{$value}','{$updated_at}')";
             $result = $result = $database->execute_query($query);
             if ($result) {
                       header('location:posts.php?msg=post updated successfully');
                    }else{
                        header('location:posts.php?msg=post Not Updated Perfectly Try Again After While');
                    }
          }
         if (isset($_FILES['attachment_files'])) {
            $attachmentDir = "post_attachments/";
            foreach ($_FILES['attachment_files']['name'] as $index => $filename) {
                
                if ($_FILES['attachment_files']['error'][$index] != 0) {
                    continue;
                }

                $attachmentPath = $attachmentDir . basename($filename);
                if (move_uploaded_file($_FILES['attachment_files']['tmp_name'][$index], $attachmentPath)) {
                    $attachmentTitle = $_POST['attachment_titles'][$index];

                    $query = "INSERT INTO post_atachment (post_id, post_attachment_title, post_attachment_path, is_active, created_at) 
                              VALUES ('{$post_id}', '{$attachmentTitle}', '{$attachmentPath}', 'Active', '{$created_at}')";
                     $result  =  $database->execute_query($query);
                    if ($result) {
                       header('location:posts.php?msg=post updated successfully');
                    }else{
                        header('location:posts.php?msg=post Not Updated Perfectly Try Again After While');
                    }
                }
            }
        }
     }
       
}


     if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_comment') {
        
        $status_text = $comment_status == "Active" ? "InActive" : "Active";

        $query = "UPDATE post_comment SET is_active = '{$status_text}' WHERE post_comment_id = '{$comment_id}'";
        $result = $database->execute_query($query);
        if ($result) {
            header("location:post_comments.php?msg=Comment Status Has Been Changed&post_id=$post_id");
        }else{
            header('location:post_comments.php?msg=Something Went Wrong');
        }
     }


     hello iam ali yder mallah
?>
