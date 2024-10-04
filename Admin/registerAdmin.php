<?php 
include_once('../HF/header.php');
?>
<center>
    <h1 class="display-4" style="color: royalblue; font-weight: 600; text-shadow: 0 0 5px #0000FF, 0 0 10px #FF0000;">Marvel Blog</h1>
    <br/>
    <h3 style="color: #333; font-weight: 600; text-shadow: 0 0 5px #0000FF, 0 0 10px #FF0000;">Admin Registration Panel</h3>
    <br/>
    <!-- Registration Form Start -->
    <div class="container">
        <div class="card" style="max-width: 400px; margin: 0 auto;">
            <div class="card-header bg-primary text-white">
                <h4>Register New User Or Admin</h4>
            </div>
            <div class="card-body bg-light">
                <form action="../process.php?action=Adminregister" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                    
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

                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select class="form-select" id="role" name="role_id" required>
                            <option selected disabled>Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <input class="register btn btn-primary" type="submit" name="submit" value="Register">
                        <button type="reset" class="btn btn-secondary register">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</center>

<script src="../js/script.js"></script>
<?php 
include_once('../HF/footer.php');
?>
