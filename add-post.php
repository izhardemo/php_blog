<?php
session_start();

include('./db/mysql.php');

include('./include/header.php');
include('./include/sidebar.php');


$data = "SELECT * FROM posts";
$view = mysqli_query($conn, $data);

?>
<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php
    include('./include/navbar.php');
    ?>
    <!-- Navbar End -->

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Post List</h6>
                <a href="post.php" class="btn btn-primary btn-sm">Back</a>
            </div>
            <form id="postFrm" action="function.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label fs-6 fw-bolder">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label fs-6 fw-bolder">Content</label>
                    <textarea name="content" class="form-control" id="content" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label fs-6 fw-bolder">Author</label>
                    <input type="text" name="author" class="form-control" id="author" placeholder="Author" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label fs-6 fw-bolder">Image</label>
                    <input type="file" name="image" class="form-control" id="image" required>
                </div>
                <div class="mb-5 border-top">
                    <input type="submit" name="submit" class="btn btn-primary mt-3" id="btn-save">
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Start -->
    <?php
    include('./include/footer.php');
    ?>
    <!-- Footer End -->
</div>
<!-- Content End -->
<?php
include('./include/script.php');
?>