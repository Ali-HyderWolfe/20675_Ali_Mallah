<?php  
             session_start();

       if ($_SESSION['data']['role_id'] == 1) {
       }else{
        header('location:../index.php?msg=Logout Successfully');
       }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel Blog Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
      button {
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        button:hover {
            opacity: 0.8;
        }
        button[type="submit"]:not([value="InActive"]) {
            background-color: red;
        }
        button[type="submit"][value="InActive"] {
            background-color: green;
        }
    </style>
</head>
<body>
<!-- navbar Start -->

    <nav class="navbar navbar-expand-lg bg-white mb-3 shadow-lg sticky-top ">
  <div class="container-fluid navi">
    <a class="navbar-brand" href="Admindashboard.php"><h2>Marvel Blog</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        

        <li class="nav-item me-3">
          <a class="btn btn-primary register" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
 Admin Panel
</a>

        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="AdminDashboard.php">Home</a>
        </li>
        
<a class="btn btn-primary register" href="../Admin/session.php">Logout</a>

      </ul>
    </div>
  </div>
</nav>
 
<!-- navbar End -->
<!-- Admin With Display Profile And more-->
<div class="container mb-4">
  <div class="row">
    <div class="col-sm-9">
      <h3  style="font-weight: 600; color: black; text-shadow: 0 0 7px black, 0 0 10px gold;">Create And Update</h3>
      <a href="createBlog.php" class="btn btn-success me-2">Create Blog</a>
      <a href="createPost.php" class="btn btn-info me-2">Create Post</a>
      <a href="Adminupdate.php?action=updateadmin" class="btn btn-warning ">Update Profile</a>
      &nbsp;&nbsp;<div class="btn-group">
  <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Goto
  </button>
  <ul class="dropdown-menu bg-success text-white">
    <li style="width:90%"><a class="dropdown-item" href="#">Theme</a></li>
    <li style="width:90%"><a class="dropdown-item" href="../Admin/session.php">Logout</a></li>
    <li style="width:90%"><a class="dropdown-item" href="#">Settings</a></li>
    <li style="width:90%"><hr class="dropdown-divider"></li>
    <li style="width:90%"><a class="dropdown-item" href="../index.php">Goto Front Panel</a></li>
  </ul>
</div>

    </div>
    <div class="col-sm-3 text-end">
      <h3><?= $_SESSION['data']['first_name']." ".$_SESSION['data']['last_name'];?></h3>

      <img class="dpimage img-thumbnail" src="../<?= $_SESSION['data']['user_image'];?>" alt="Display Profile" style="width:150px;height:150px;">
    </div>
  </div>
  <hr>
</div>
<!-- Admin With Display Profile And more-->


<!-- sidebar start -->





<div class="offcanvas offcanvas-start bg-white text-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Admin Panel</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
    </button>
  </div>
  <div class="offcanvas-body">
    <div>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-3" href="Adminblogs.php">Blogs</a>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="posts.php">Posts</a>
        </li>
      <li class="nav-item">
          <a class="nav-link me-3" href="approvals.php">User Approvals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="users.php">Edit Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="active.php">Active Users Or Inactive</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="feedback.php">Feedbacks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="categories.php">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="followers.php">Followers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="registerAdmin.php">Add User/Admin</a>
        </li>
       </ul>
    </div>
  </div>
</div>




<!-- sidebar end -->