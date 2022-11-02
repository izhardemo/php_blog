<?php
session_start();

include('./db/mysql.php');

// Post
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $image = $_FILES['image'];
    if ($image['size'] > 0) {
        $filename = 'image_'.time(). '.' .pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);;
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/" . $filename;
            
        // upload image
        move_uploaded_file($tempname, $folder);
    } else {
        $filename = NULL;
    }
    if(!empty($title) && !empty($content)){
        $sql = "INSERT INTO posts (`title`, `content`, `author`, `image`) VALUES ('$title', '$content', '$author', '$filename');";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION['success'] = 'New Post Insert Successfully';
            header('Location: post.php');
            exit;
        }else {
            $_SESSION['error'] = "Error: $sql " . mysqli_error($conn);
            header('Location: post.php');
            exit;
        }  
    } else{
        echo "Please enter details";
    }   
}

if(isset($_POST['edit'])){
    $sql = "SELECT * FROM posts WHERE `id` = '".$_POST['id']."'";
    $row = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($row);

    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $image = $_FILES['image'];
    if ($image['size'] > 0) {
        $filename = 'image_'.time(). '.' .pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);;
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./image/" . $filename;
        
        // delete exist image
        unlink('./image/'.$data['image']);
        // upload image
        move_uploaded_file($tempname, $folder);
    } else {
        $filename = $data['image'];
    }
    if(!empty($title) && !empty($content)){
        $sql = "UPDATE `posts` SET `title` = '$title', `content` = '$content', `author` = '$author', `image` = '$filename' WHERE `id` = '".$_POST['id']."'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION['success'] = 'Post Updated Successfully';
            header('Location: post.php');
            exit;
        }else {
            $_SESSION['error'] = "Error: $sql " . mysqli_error($conn);
            header('Location: post.php');
            exit;
        }  
    } else{
        echo "Please enter details";
    }   
}

// delete data
if(isset($_POST['delete']))
{
    $sql = "SELECT * FROM posts WHERE `id` = {$_REQUEST['id']}";
    $row = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($row);

    $del = "DELETE FROM posts WHERE `id` = {$_REQUEST['id']}";

    if (mysqli_query($conn, $del)) {
        // delete exist image
        unlink('./image/'.$data['image']);

        $_SESSION['success'] = 'Post Deleted Successfully';
        header('Location: post.php');
        exit;
    } else {
        $_SESSION['error'] = "Error: $del " . mysqli_error($conn);
        header('Location: post.php');
        exit;
    }
}

// comment
if(isset($_POST['commentSave'])){
    $sql1 = "SELECT * FROM comments WHERE `id` = '".$_POST['id']."'";
    $row = mysqli_query($conn, $sql1);
    $data = mysqli_fetch_assoc($row);
    $comment = $_POST['comment'];
    
    if(!empty($comment)){
        $sql = "UPDATE comments SET comment = '$comment' WHERE `id` = '".$_POST['id']."'";
        $result = mysqli_query($conn, $sql);
        
        if($result){
            $_SESSION['success'] = 'Comment Updated Successfully';
            header('Location: comment.php?id='.$data['post_id']);
            exit;
        }else {
            $_SESSION['error'] = "Error: $sql " . mysqli_error($conn);
            header('Location: comment.php?id='.$data['post_id']);
            exit;
        }  
    } else{
        echo "Please enter details";
    }   
}

if(isset($_POST['deleteComment']))
{
    $sql = "SELECT * FROM comments WHERE `id` = {$_REQUEST['id']}";
    $row = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($row);

    $del = "DELETE FROM comments WHERE `id` = {$_REQUEST['id']}";

    if (mysqli_query($conn, $del)) {
        $_SESSION['success'] = 'Comment Deleted Successfully';
        header('Location: comment.php?id='.$data['post_id']);
        exit;
    } else {
        $_SESSION['error'] = "Error: $del " . mysqli_error($conn);
        header('Location: comment.php?id='.$data['post_id']);
        exit;
    }
}