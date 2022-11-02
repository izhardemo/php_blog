<?php
session_start();

include('./db/mysql.php');

include('./include/header.php');
include('./include/sidebar.php');


$sql = "SELECT * FROM posts WHERE `id` = '".$_POST['id']."'";
$row = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($row);

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
                <h6 class="mb-0">Edit Post</h6>
                <a href="post.php" class="btn btn-primary btn-sm">Back</a>
            </div>
            <form id="postFrm" action="function.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$data['id']?>">
                <div class="mb-3">
                    <label for="title" class="form-label fs-6 fw-bolder">Title</label>
                    <input type="text" name="title" value="<?=$data['title']?>" class="form-control" id="title" placeholder="Title" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label fs-6 fw-bolder">Content</label>
                    <textarea name="content" class="form-control" id="content" rows="4" required><?=$data['content']?></textarea>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label fs-6 fw-bolder">Author</label>
                    <input type="text" name="author" value="<?=$data['author']?>" class="form-control" id="author" placeholder="Author">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label fs-6 fw-bolder">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                    <?php
                    if (isset($data['image'])) { ?>
                        <div>
                            <img src="../image/<?=$data['image']?>" alt="" class="img-thumbnail" style="height: 80px;">
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-5 border-top">
                    <input type="submit" name="edit" class="btn btn-primary mt-3">
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