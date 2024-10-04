<?php 
include_once('../HF/header.php');

// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";
extract($_REQUEST);
?>

<!-- Edit Form Start -->
<div class="alert alert-success" role="alert">
    <?php 
    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }
    ?>
</div>

<div class="container mt-5">
    <div class="card" style="width: 400px;">  
        <div class="card-header bg-warning text-white">
            <h4>Update User Data</h4>
        </div>
        <div class="card-body bg-white text-warning">
            <form action="process.php?action=edit" method="POST">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstname" value="<?= $first_name ?>" required>
                </div>

                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastname" value="<?= $last_name ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?= $gender === 'Male' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?= $gender === 'Female' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="date_of_birth" value="<?= $date_of_birth ?>" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required><?= $address ?></textarea>
                </div>

                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
                <div class="d-grid gap-2">  
                    <button type="submit" class="btn btn-primary">Update Record</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Form End -->

<?php 
include_once('../HF/footer.php');
?>
