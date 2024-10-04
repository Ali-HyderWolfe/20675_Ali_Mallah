<?php
session_start();

require_once "database_class.php";
require_once "fpdf/fpdf.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
require "PHPMailer/src/Exception.php";

echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
extract($_REQUEST);
date_default_timezone_set("asia/karachi");
$created_at = date("Y-m-d H:i:s");

// User Registration
if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "userregister") {
    $uploaddir = "uploads/";
    $uploadfile = $uploaddir . basename($_FILES["file"]["name"]);

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile)) {
            echo "image uploaded Successfully";
        }
    }

    $updated_at = $created_at;
    $is_approved = "pending";
    $is_active = "inactive";
    $role_id = "2";

    $query = "INSERT INTO user (role_id, first_name, last_name, email, password, gender, date_of_birth, address, user_image, is_approved, is_active, created_at, updated_at) 
              VALUES ('{$role_id}', '{$first_name}', '{$last_name}', '{$email}', '{$password}', '{$gender}', '{$date_of_birth}', '{$address}', '{$uploadfile}', '{$is_approved}', '{$is_active}', '{$created_at}', '{$updated_at}')";

    $result = $database->execute_query($query);

    if ($result) {
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFillColor(0, 0, 128);
        $pdf->Rect(0, 0, 210, 297, "F");

        $pdf->SetFont("Arial", "B", 24);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 20, "Marvel Blog Account Details", 0, 1, "C");
        $pdf->Ln(10);

        $pdf->SetFont("Arial", "", 14);
        $pdf->SetTextColor(255, 255, 255);

        $pdf->Cell(50, 10, "Name: ", 0, 0);
        $pdf->Cell(100, 10, $first_name . " " . $last_name, 0, 1);

        $pdf->Cell(50, 10, "Email: ", 0, 0);
        $pdf->Cell(100, 10, $email, 0, 1);

        $pdf->Cell(50, 10, "Password: ", 0, 0);
        $pdf->Cell(100, 10, $password, 0, 1);

        $pdf->Cell(50, 10, "Gender: ", 0, 0);
        $pdf->Cell(100, 10, $gender, 0, 1);

        $pdf->Cell(50, 10, "Date of Birth: ", 0, 0);
        $pdf->Cell(100, 10, $date_of_birth, 0, 1);

        $pdf->Cell(50, 10, "Address: ", 0, 0);
        $pdf->MultiCell(100, 10, $address);

        $pdf_file_path = "reports/" . $first_name . " " . $last_name . ".pdf";
        $pdf->Output("F", $pdf_file_path);

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

        $mail->addAddress($email);

        $mail->Subject = "Account Successfully Created";
        $mail->isHTML(true);
        $mail->Body =
            "Account Successfully Created And Present Status Is Pending. Wait For Admin To Approve Your Account. After Confirmation, We will Inform you Through Email. Thank you For Registration.";

        $mail->addAttachment($pdf_file_path);

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

        header(
            "location:index.php?msg=Registration Successfully Wait For Admin To Approve Your Account Thank you.",
        );
    } else {
        header("location:index.php?msg=Something Went Wrong Please Try Again");
    }
}


// Admin Registration
if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "Adminregister") {
    $uploaddir = "uploads/";
    $uploadfile = $uploaddir . basename($_FILES["file"]["name"]);

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile)) {
            echo "image uploaded Successfully";
        }
    }

    $updated_at = $created_at;
    $is_approved = "pending";
    $is_active = "inactive";

    $query = "INSERT INTO user (role_id, first_name, last_name, email, password, gender, date_of_birth, address, user_image, is_approved, is_active, created_at, updated_at) 
              VALUES ('{$role_id}', '{$first_name}', '{$last_name}', '{$email}', '{$password}', '{$gender}', '{$date_of_birth}', '{$address}', '{$uploadfile}', '{$is_approved}', '{$is_active}', '{$created_at}', '{$updated_at}')";

    $result = $database->execute_query($query);

    if ($result) {
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFillColor(0, 0, 128);
        $pdf->Rect(0, 0, 210, 297, "F");

        $pdf->SetFont("Arial", "B", 24);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 20, "Marvel Blog Account Details", 0, 1, "C");
        $pdf->Ln(10);

        $pdf->SetFont("Arial", "", 14);
        $pdf->SetTextColor(255, 255, 255);

        $pdf->Cell(50, 10, "Name: ", 0, 0);
        $pdf->Cell(100, 10, $first_name . " " . $last_name, 0, 1);

        $pdf->Cell(50, 10, "Email: ", 0, 0);
        $pdf->Cell(100, 10, $email, 0, 1);

        $pdf->Cell(50, 10, "Password: ", 0, 0);
        $pdf->Cell(100, 10, $password, 0, 1);

        $pdf->Cell(50, 10, "Gender: ", 0, 0);
        $pdf->Cell(100, 10, $gender, 0, 1);

        $pdf->Cell(50, 10, "Date of Birth: ", 0, 0);
        $pdf->Cell(100, 10, $date_of_birth, 0, 1);

        $pdf->Cell(50, 10, "Address: ", 0, 0);
        $pdf->MultiCell(100, 10, $address);

        $pdf_file_path = "reports/" . $first_name . " " . $last_name . ".pdf";
        $pdf->Output("F", $pdf_file_path);

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

        $mail->addAddress($email);

        $mail->Subject = "Account Successfully Created";
        $mail->isHTML(true);
        $mail->Body =
            "Account Successfully Created And Present Status Is Pending. Wait For Admin To Approve Your Account. After Confirmation, We will Inform you Through Email. Thank you For Registration.";

        $mail->addAttachment($pdf_file_path);

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

        header(
            "location:Admin/Admindashboard.php?msg=Registration Successfully Now you Can Approve User Account from User Aprovals.",
        );
    } else {
        header(
            "location:Admin/Admindashboard.php?msg=Something Went Wrong Please Try Again",
        );
    }
}

if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "login") {
    $query = "SELECT * FROM user WHERE email = '{$email}' AND password ='{$password}'";
    $result = $database->execute_query($query);

    if ($result->num_rows > 0) {
        $_SESSION["data"] = mysqli_fetch_assoc($result);

        if ($_SESSION["data"]["is_approved"] == "Approved") {
            if ($_SESSION["data"]["is_active"] == "Active") {
                if ($_SESSION["data"]["role_id"] == 1) {

                    header("location:Admin/Admindashboard.php");

                } elseif ($_SESSION["data"]["role_id"] == 2) {
                    header("location:index.php?msg=login Successfully");
                }
            } elseif ($_SESSION["data"]["is_active"] == "InActive") {
                header("location:login.php?msg=Your Account Is InActive");
            } else {
                header("location:login.php?msg=Something Went Wrong");
            }
        } elseif ($_SESSION["data"]["is_approved"] == "Rejected") {
            header(
                "location:login.php?msg=You Are Rejected From Admin To join The Marvel Blog Sorry you Cant Login Here",
            );
        } elseif ($_SESSION["data"]["is_approved"] == "Pending") {
            header(
                "location:login.php?msg=Your Account Is Not Approved By Admin Account Is In Pending Status. ",
            );
        } else {
            header("location:login.php?msg=Something Went Wrong");
        }
    } else {
        header("location:login.php?msg=Email Or Password Is Incorrect");
    }
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'feedback') {
    $query = "INSERT INTO user_feedback (user_name,user_email,feedback,created_at) 
    VALUES ('{$name}','{$email}','{$message}','{$created_at}')";

    $result = $database->execute_query($query);

    if ($result) {
        $query = "SELECT * FROM user where role_id = 1 ";
        $result = $database->execute_query($query);

         if ($result->num_rows > 0) {
             while ($row = mysqli_fetch_assoc($result)) {
                 $admin_emails  = $row['email'];


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
             
             
        $mail->addAddress($admin_emails);

        $mail->Subject = "Guest FeedBack Notification Email";
        $mail->isHTML(true);
        $mail->Body ="<div><b>This Is the Feedback From Guest To Marvel Blog </br>
        Email: $email </br>
        Name: $name  </br>
        Feedback: $message </br>
        At The Time And Date $created_at </br>
        this feedback You Can delete From Accessing Your Account Dashboard/Feedbacks</b></div> ";

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

    }
    }
        header('location:index.php?msg=feedback Has Been Sent Successfully');
         }else{
            header('location:index.php?msg=Something Went Wrong try Again');
         }
}


    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'feedbackuser') {
         
         $query = "SELECT * FROM user WHERE user_id = '{$user_id}'";
         $result = $database->execute_query($query);

         $row['feed'] = mysqli_fetch_assoc($result);

        $query = "INSERT INTO user_feedback (user_id,user_name,user_email,feedback,created_at)
        VALUES ('{$user_id}','{$row['feed']['first_name']}',
            '{$row['feed']['email']}','{$message}','{$created_at}')";

            $result = $database->execute_query($query);
            
            if ($result) {
        $query = "SELECT * FROM user where role_id = 1 ";
        $result = $database->execute_query($query);

         if ($result->num_rows > 0) {
             while ($row = mysqli_fetch_assoc($result)) {
                 $admin_emails  = $row['email'];


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
             
             
        $mail->addAddress($admin_emails);

        $mail->Subject = "User Feedback Notification Email";
        $mail->isHTML(true);
        $mail->Body ="<div><b>This Is the Feedback From Registered User To Marvel Blog </br>
        Email: $email </br>
        Name: $name </br>
        Feedback: $message </br>
        At The Time And Date $created_at </br>
        this feedback You Can delete From Accessing Your Account Dashboard/Feedbacks</b></div> ";

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

    }
    }
        header('location:index.php?msg=feedback Has Been Sent Successfully');
         }else{
            header('location:index.php?msg=Something Went Wrong try Again');
         }
    }


    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "forgot") {
        if ($email_1 == $email_2) {
            $query = "SELECT * FROM user WHERE email = '{$email_2}'";
            $result = $database->execute_query($query);
            if ($result->num_rows > 0) {
                $forgot = mysqli_fetch_assoc($result);
                extract($forgot);

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
             
             
        $mail->addAddress($email);

        $mail->Subject = "Forgot Password";
        $mail->isHTML(true);
        $mail->Body ="<h5>Forgot Password Successfully 
        Necessary Details For Login Your Account </br>
        Your Email :$email</br> 
        Your Password: $password </h5>";

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        
        header('location:login.php?msg=Your Pssword and Email Has Been Sent Successfully To your Email You Registered At Marvel Blog Now You Can Login');
                
            }
        }else{
            header('location:forgot.php?msg=Email Not Matched Try Your Valid Email');
        }
    }

    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "post_comment") {
        
        $query = "INSERT INTO post_comment (post_id,user_id,comment,is_active,created_at)
        VALUES ('{$post_id}','{$user_id}','{$comment}','Active','{$created_at}')";

        $result = $database->execute_query($query);
        if ($result) {
           
            header("location:viewpost.php?post_id=$post_id");
            
        }else{
            header("location:viewpost.php?post_id=$post_id&msg=Something Went Wrong");
        }
    }
    
?>
