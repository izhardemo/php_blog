<?php
session_start();

include('./db/mysql.php');

include('./include/header.php');
include('./include/sidebar.php');


$sql = "SELECT comments.id, comments.post_id, comments.comment, posts.title FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.id = {$_REQUEST['id']}";
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
                <h6 class="mb-0">Edit Comment</h6>
                <a href="comment.php?id=<?=$data['post_id']?>" class="btn btn-primary btn-sm">Back</a>
            </div>
            <form action="function.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$data['id']?>">
                <div class="mb-3">
                    <label for="title" class="form-label fs-6 fw-bolder">Title</label>
                    <input type="text" name="title" value="<?=$data['title']?>" class="form-control" id="title" placeholder="Title" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label fs-6 fw-bolder">Comment</label>
                    <textarea name="comment" class="form-control" id="comment" rows="4" required><?=$data['comment']?></textarea>
                </div>
                <div class="mb-5 border-top">
                    <input type="submit" name="commentSave" class="btn btn-primary mt-3">
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