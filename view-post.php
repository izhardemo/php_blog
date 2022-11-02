<?php
include('./db/mysql.php');
include('./helper.php');

$sql = "SELECT * FROM posts WHERE id = {$_REQUEST['id']}";
$row = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($row);
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

<div class="container mt-3">
    <div class="mb-3">
        <h3><?=ucwords($data['title'])?></h3>
        <img src="./image/<?=$data['image']?>" alt="" class="img-thumbnail" style="height: 300px; object-fit:contain;">
        <p class="mt-3"><?=$data['content']?></p>
    </div>
    <!-- comment -->
    <div class="my-5">
        <form action="" method="post">
            <div class="">
                <textarea name="comment" placeholder="Comment" class="form-control" rows="4"></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
    $comment = $_POST['comment'];
    if(!empty($comment)){
        $id = $_REQUEST['id'];
        $sql = "INSERT INTO comments (`post_id`, `comment`) VALUES ('$id', '$comment');";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION['success'] = 'Comment added Successfully';
            header('Location: index.php');
            exit;
        }else {
            $_SESSION['error'] = "Error: $sql " . mysqli_error($conn);
            header('Location: index.php');
            exit;
        }  
    } else{
        echo "Please enter details";
    }   
}
?>