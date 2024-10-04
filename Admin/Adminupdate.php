<?php 
include_once('../HF/header.php');
require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
?>
<center>
    <h1 class="display-4" style="color: royalblue; font-weight: 600; text-shadow: 0 0 7px #FF4500;">Marvel Blog</h1>
    <br/>
    <h3 style="color: black; font-weight: 600; text-shadow: 0 0 7px #FF4500;">Update Admin Profile</h3>
    <br/>
    <!-- Registration Form Start -->
    <div class="container">
        <div class="card" style="width: 350px; border: 2px solid royalblue;">
            <div class="card-header bg-light text-dark">
                <h4>Update Data Below</h4>
            </div>
            <div class="card-body bg-white text-dark">
                <form action="process.php?action=updateadmin" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['data']['user_id']; ?>">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" value="<?php echo $_SESSION['data']['first_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" value="<?php echo $_SESSION['data']['last_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['data']['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $_SESSION['data']['password']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required <?php if ($_SESSION['data']['gender'] == 'Male') echo 'checked'; ?>>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required <?php if ($_SESSION['data']['gender'] == 'Female') echo 'checked'; ?>>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="date_of_birth" value="<?php echo $_SESSION['data']['date_of_birth']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_image" class="form-label">User Profile</label>
                        <input class="form-control" type="file" id="user_image" name="user_image" accept="image/*" required>
                        <?php if (!empty($_SESSION['data']['user_image'])) { ?>
                            <small class="form-text text-warning">Current image: <img style="width: 60px" src="../<?php echo $_SESSION['data']['user_image']; ?>" alt=""></small>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Address"><?php echo $_SESSION['data']['address']; ?></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary me-2">Update Data</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</center>
<?php 
include_once('../HF/footer.php');
?>
