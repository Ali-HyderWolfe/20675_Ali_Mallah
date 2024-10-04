<?php 
include_once('../HF/header.php');
require_once "../database_class.php";

$database = new Database(HOST_NAME, USER_NAME, PASSWORD, DATABASE);
?>

<!-- adding category start -->
<div class="container mt-4">
    <h3 class="text-white text-center" style="font-weight: 600; text-shadow: 0 0 7px #0000FF, 0 0 10px red;">Add New Category</h3>
    <form action="process.php?action=categorie" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" id="categoryTitle" name="title" placeholder="Enter Category Title" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control" id="categoryDescription" name="description" placeholder="Enter Category Description" required></textarea>
        </div>
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-primary">Add Category</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</div>
<!-- adding category end -->

<!-- display category start -->
<div class="alert alert-success" role="alert">
    <?php 
        if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        }
    ?>
</div>
<div class="container">
    <table id="myTable" class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Title</th>
                <th>Category Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $query = "SELECT * FROM category";
                $result = $database->execute_query($query);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $row['category_id']; ?></td>
                <td><?= $row['category_title']; ?></td>
                <td><?= $row['category_description']; ?></td>
                <td><?= $row['category_status']; ?></td>
                <td><?= $row['created_at']; ?></td>
                <td><?= $row['updated_at']; ?></td>
                <td style="display:flex;">
                    <form action="process.php?action=categoryactive" method="post" class="me-2">
                        <input type="hidden" name="category_id" value="<?= $row['category_id']; ?>">
                        <input type="hidden" name="category_status" value="<?= $row['category_status']; ?>">
                        <button type="submit" class="btn <?= $row['category_status'] == 'Active' ? 'btn-warning' : 'btn-success'; ?>">
                            <?= $row['category_status'] == 'Active' ? 'InActive' : 'Active'; ?>
                        </button>
                    </form>
                    <form action="process.php?action=deletecategory" method="POST">
                        <input type="hidden" name="category_id" value="<?= $row['category_id']; ?>">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php 
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<!-- display category end -->

<?php 
include_once('../HF/footer.php');
?>
