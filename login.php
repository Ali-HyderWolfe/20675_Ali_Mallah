<?php require_once('HF/head.php'); ?>
<center>
    <h1 class="display-4" style="color: royalblue; font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px #FF0000;">Marvel Blog</h1>
    <br/>
    <h3 style="color: darkslategray; font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Login Here</h3>
    <br/>

    <!-- Login Form Start -->
    <div class="container">
        <div class="alert alert-success" role="alert">
            <?php 
                if (isset($_GET['msg'])) {
                    echo $_GET['msg'];
                }
                echo "hello";
            ?>
        </div>

        <div class="card" style="width: 350px;">
            <div class="card-header bg-primary text-white">
                <h4>Login</h4>
            </div>
            <div class="card-body bg-light text-dark">
                <form action="process.php?action=login" method="POST" onsubmit="return validateForm()">
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

                    <div class="text-end">
                        <a href="forgot.php">Forgot Password?</a>
                        <input class="btn btn-primary" type="submit" name="submit" value="Login">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Form End -->
</center>

<?php require_once('HF/foot.php'); ?>  
