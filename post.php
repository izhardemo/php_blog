<?php
session_start();

include('./db/mysql.php');
include('./helper.php');

include('./include/header.php');
include('./include/sidebar.php');


$sql = "SELECT * FROM posts";
$view = mysqli_query($conn, $sql);

?>
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <?php
        include('./include/navbar.php');
        ?>
        <!-- Navbar End -->

        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Post List</h6>
                    <a href="add-post.php" class="btn btn-primary btn-sm">Add Post</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Author</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(mysqli_num_rows($view) > 0){
                            $sn = 1;
                            while($row = mysqli_fetch_assoc($view)){
                                echo "<tr>";
                                echo "<td>" . $sn . "</td>";
                                echo "<td style='text-align:left;'>" . $row['title'] . "</td>";
                                echo "<td>" . getShorterString($row['content'], 50) . "</td>";
                                echo "<td>" . $row['author'] . "</td>";
                                echo"<td>"; 
                                $id=$row['id'];
                                ?>
                                <div class="d-flex justify-content-evenly">
                                    <a href="./comment.php?id=<?=$row['id']?>" class="btn btn-info btn-sm">View Comments</a>
                                    <form action="edit-post.php" method="post">
                                        <input type="submit" name="edit" class="btn btn-primary btn-sm" id="edit" value="Edit">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    </form>
                                    <form action="function.php" method="post">
                                        <input type="submit" name="delete" class="btn btn-danger btn-sm" id="delete" value="Delete">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    </form>
                                </div>
                                <?php
                                echo '</td>';
                                echo "</tr>";
                                $sn++;
                            }
                        } else{
                            echo "<tr>";
                            echo "<td colspan='6'>0 Result</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
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

<script>
    var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    });
    
    function success(message) {
        Toast.fire({
            icon: 'success',
            text: message,
        }); 
    }

    function error(message) {
        Toast.fire({
            icon: 'error',
            text: message,
        }); 
    }
</script>

<?php
    if(isset($_SESSION['success'])){
        echo "<script>success('".$_SESSION['success']."')</script>";
    }
    if(isset($_SESSION['error'])){
        echo "<script>error(".$_SESSION['error'].")</script>";
    }
    
    session_destroy();
?>