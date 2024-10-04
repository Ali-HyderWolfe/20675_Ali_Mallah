<?php
session_start();

$loggedIn = isset($_SESSION['data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css"> 
    <style>
        .navbar-nav .btn {
            margin-left: 10px;
        }
        .postcard{
            border: none;
        }
        a[href$=".pdf"] {
    background: url("https://lms.histpk.org/theme/image.php/azuline29/core/1617621814/f/pdf-24");
    background-repeat: no-repeat;
    padding-left: 30px;
        }
        a[href$=".pptx"] {
    background: url("https://lms.histpk.org/theme/image.php/azuline29/core/1617621814/f/powerpoint-24");
    background-repeat: no-repeat;
    padding-left: 30px;

        }
        a[href$=".docx"] {
    background: url("https://lms.histpk.org/theme/image.php/azuline29/core/1617621814/f/document-24");
    background-repeat: no-repeat;
    padding-left: 30px;

        }
        a[href$=".zip"] {
    background: url("https://lms.histpk.org/theme/image.php/azuline29/core/1617621814/f/archive-24");
    background-repeat: no-repeat;
    padding-left: 30px;

        }
        a[href$=".txt"] {
    background: url("https://lms.histpk.org/theme/image.php/azuline29/assign/1617621814/icon");
    background-repeat: no-repeat;
    padding-left: 30px;

        }


    </style>
</head>
<body>
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-dark mb-3 shadow-sm shadow-lg sticky-top ">
  <div class="container-fluid navi">
    <a class="navbar-brand" href="#"><h2>Marvel Blog</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if (!$loggedIn){ ?>
            <li class="nav-item">
                <a class="btn btn-primary" href="register.php">Register</a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link me-3" href="index.php">News Feed</a>
        </li>
        <?php if ($loggedIn){ ?>
            <li class="nav-item">
                <a class="btn btn-primary" href="Admin/session.php?action=logout">Logout</a>
            </li>
            <div class="btn-group">
  <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Goto
  </button>
  <ul class="dropdown-menu bg-success">
    <li style="width:90%"><a class="dropdown-item" href="#">Theme</a></li>
    <li style="width:90%"><a class="dropdown-item" href="#">Settings</a></li>
    <?php if ($_SESSION['data']['role_id'] == 1){ ?>
        
    
    <li style="width:90%"><a class="dropdown-item" href="Admin/Admindashboard.php">Goto Dashboard</a></li>
    <?php } ?>
  </ul>
</div>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar End -->