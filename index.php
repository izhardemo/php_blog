<?php
include('./db/mysql.php');
include('./helper.php');

$sql = "SELECT * FROM posts";
$view = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">News Blog</a>
        </div>
    </nav>

    <div class="container mt-3 mb-5">
        <?php
        if(mysqli_num_rows($view) > 0){
            while($row = mysqli_fetch_assoc($view)){
            ?>
            <div class="mb-3 border p-4">
                <h3><?=ucwords($row['title'])?></h3>
                <img src="./image/<?=$row['image']?>" alt="" class="img-thumbnail" style="height: 300px; object-fit:contain;">
                <p class="mt-3"><?=getShorterString($row['content'], 100)?></p>
                <a href="view-post.php?id=<?=$row['id']?>">Read more</a>
            </div>
        <?php }
        } else{
            echo "No post found.";
        }
        ?>
    </div>

</body>
</html>