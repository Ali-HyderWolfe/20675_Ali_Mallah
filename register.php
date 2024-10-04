<?php require_once('HF/head.php'); ?>
<center>
    <h1 class="display-4" style="color: royalblue; font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px #FF0000;">Marvel Blog</h1>
    <br/>
    <h3 style="color: darkslategray; font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Registration</h3>
    <br/>

    <!-- Registration Form Start -->
    <div class="alert alert-success" role="alert">
        <?php 
            if (isset($_GET['msg'])) {
                echo $_GET['msg'];
            }
        ?>
    </div>
    <div class="container">
        <div class="card" style="width: 350px;">
            <div class="card-header bg-primary text-white">
                <h4>Register New User</h4>
            </div>
            <div class="card-body bg-light text-dark">
                <form action="process.php?action=userregister" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter First Name" required>
                        <span id="firstNameError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter Last Name" required>
                        <span id="lastNameError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        <span id="emailError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        <span id="passwordError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <span id="genderError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="date_of_birth" required>
                        <span id="dobError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="profileImage" class="form-label">Profile Image</label>
                        <input class="form-control" type="file" id="profileImage" name="file" accept="image/*">
                        <span id="imageError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Address" required></textarea>
                        <span id="addressError" class="text-danger"></span>
                    </div>

                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" name="submit" value="Register">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Registration Form End -->
</center>

<?php require_once('HF/foot.php'); ?>  
