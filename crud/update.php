<?php include "header.php";
require_once("classes/Crud.php");
$crud = new Crud();
if (!isset($_GET['pid'])) {
    header("Location:index.php");
    die();
} else {
    $pid = $_GET['pid'];
    $query = "select * from post where post_id = $pid";
    $result = $crud->getData($query);
    foreach ($result as $key => $row) {
    $post_id = $row['post_id'];
    $title = $row['title'];
    $date = $row['date'];
    $time = $row['time'];
    $priority = $row['priority'];
    $notification = $row['notification'];
    $tags = $row['tags'];
    $category = $row['category'];
    $post_img = $row['post_img'];
    }
}
?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="post_id" class="form-control" required value="<?php echo $post_id; ?>">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" required value="<?php echo $title; ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_date">Date</label>
                        <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" autocomplete="off" required \>
                    </div>
                    <div class="form-group">
                        <label for="post_time">Time</label>
                        <input type="time" name="time" class="form-control" value="<?php echo $time; ?>" autocomplete="off" required \>
                    </div>
                    <div class="form-group">
                        <label for="post_priority">Priority</label>
                        <br>
                        <?php
                        if ($priority == "Low") {
                            $low = "checked";
                            $high = $mid = "";
                        } else if ($priority == "High") {
                            $high = "checked";
                            $low = $mid = "";
                        } else {
                            $mid = "checked";
                            $low = $high = "";
                        }
                        ?>
                        <label class="radio-inline"><input type="radio" name="priority" value="Low" <?php echo $low . $high . $mid ?>>Low</label>
                        <label class="radio-inline"><input type="radio" name="priority" value="Medium" <?php echo $low . $high . $mid ?>>Medium</label>
                        <label class="radio-inline"><input type="radio" name="priority" value="High" <?php echo $low . $high . $mid ?>>High</label>
                    </div>
                    <div class="form-group">
                        <label for="notification">Notification</label>
                        <br>
                        <?php
                        if ($notification != 0) {
                            $checked = "checked";
                        } else {
                            $checked = "";
                        }
                        ?>
                        <label class="checkbox-inline"><input type="checkbox" name="notification" <?php echo $checked ?> value="1">Notify </label>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" name="category">
                            <?php
                            $query = "select category_id,category_name from category";
                            $result = $crud->getData($query);
                            foreach ($result as $key => $row) {
                                $category_name = $row['category_name'];
                                $category_id = $row['category_id'];
                                if ($category == $category_id) {
                                    echo "<option selected value='{$category_id}'> {$category_name}</option>";
                                } else {
                                    echo "<option value='{$category_id}'> {$category_name}</option>";
                                }
                            }                            
                    
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tags">Related To (hold ctrl to select more than one):</label>
                        <select name="tags[]" multiple required class="form-control">
                            <?php
                            $tagsarray = explode(",", $tags);
                            $query = "select tag_name from tags";
                            $result = $crud->getData($query);
                            foreach ($result as $key => $row) {
                                    if (in_array($row['tag_name'], $tagsarray)) {
                                        echo "<option selected value='{$row['tag_name']}'> {$row['tag_name']}</option>";
                                    } else {
                                        echo "<option value='{$row['tag_name']}'> {$row['tag_name']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new_image">


                        <img src=<?php echo "upload/" . $post_img; ?> height="150px">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />

                </form>
                <!-- Form End -->

                <?php
                if (isset($_POST['submit'])) {
                    $title = $_POST['title'];
                    $date = $_POST['date'];
                    $time =  $_POST['time'];
                    $priority = $_POST['priority'];
                    if (isset($_POST['notification'])) {
                        $notification =  $_POST['notification'];
                    } else {
                        $notification =  0;
                    }
                    $categoryid = $_POST['category'];


                    $tags =  '';
                    foreach ($_POST['tags'] as $value) {
                        $tags .= $value . ",";
                    }
                    $tags = rtrim($tags, ",");

                    if ($_FILES['new_image']['name'] != '') {

                        $file_name = $_FILES['new_image']['name'];
                        // $file_size = $_FILES['new_image']['size'];
                        $file_tmpname = $_FILES['new_image']['tmp_name'];

                        $arrayext =  explode('.', $file_name);
                        $file_ext = strtolower(end($arrayext));
                        $extensions = array('jpeg', 'png', 'jpg', 'bmp');

                        if (!in_array($file_ext, $extensions)) {
                            echo "<div class='alert alert-danger'>Only jpeg,png,jpg,bmp files are allowed</div>";
                            die();
                        }

                        if (file_exists("upload/" . $post_img)) {
                            unlink("upload/" . $post_img);
                        } else {
                            echo 'cannot delete current file or it does not exist';
                        }
                        //update post_img later
                        $post_img = time() . "-" . $file_name;
                        move_uploaded_file($file_tmpname, "upload/" . $post_img) or die('Img Upload failed');

                         $query = "update post set post_img='$post_img',title='$title',date='$date',time='$time',category='$categoryid',priority='$priority',notification='$notification',tags='$tags' where post_id = $post_id";
                         $result = $crud->execute($query);

                    } else {

                         $query = "update post set title='$title',date='$date',time='$time',category='$categoryid',priority='$priority',notification='$notification',tags='$tags' where post_id = $post_id";
                         $result = $crud->execute($query);
                    }
                    if ($result) {
                        $URL = "index.php";
                        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- <?php include "footer.php"; ?> -->