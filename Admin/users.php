<?php 
include_once('../HF/header.php');

 require_once("../database_class.php");

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
 ?>


<!-- table of users to be approval start -->
<div class="alert alert-success" role="alert">
             <?php 
                    if (isset($_GET['msg'])) {
                      echo $_GET['msg'];
                    }
              ?>
</div>
     
     <div class="container">
      <h3 style="color: white; font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;" >All Users Will Appear Here</h3>
<table id="myTable" class="display">
    <thead>
        <tr>
            <th>R no</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Home Town</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
            <?php 
              $query = "SELECT * FROM USER ORDER BY user_id DESC";
         $result = $database->execute_query($query);
           

         if ($result->num_rows > 0) {
             while ($row = mysqli_fetch_assoc($result)) {
         ?>
        <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['first_name']." ".$row['last_name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['date_of_birth'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['is_active'] ?></td>
            <td>
                <form action="edituser.php?action=edit" method="post">
               <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
               <input type="hidden" name="first_name" value="<?= $row['first_name']; ?>">
               <input type="hidden" name="last_name" value="<?= $row['last_name']; ?>">
               <input type="hidden" name="gender" value="<?= $row['gender']; ?>">
               <input type="hidden" name="date_of_birth" value="<?= $row['date_of_birth']; ?>">
               <input type="hidden" name="address" value="<?= $row['address']; ?>">
               <button class="btn btn-warning" type="submit" value="Edit">
                    Edit
               </button>
           </form>
            </td>
        </tr>
           <?php 
             }
            }
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";

           ?>
    </tbody>
</table>
</div>
<!-- table of users to be approval end -->




<?php 
include_once('../HF/footer.php');
 ?>
