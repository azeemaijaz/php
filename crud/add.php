<?php
include "header.php";
require_once("classes/Crud.php");
$crud = new Crud();
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="admin-heading">Add New Entry</p>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Post Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required \>
                    </div>

                    <div class="form-group">
                        <label for="post_date">Date</label>
                        <input type="date" name="date" class="form-control" autocomplete="off" required \>
                    </div>
                    <div class="form-group">
                        <label for="post_time">Time</label>
                        <input type="time" name="time" class="form-control" autocomplete="off" required \>
                    </div>
                    <div class="form-group">
                        <label for="post_priority">Priority</label>
                        <br>
                        <label class="radio-inline"><input type="radio" name="priority" value="Low">Low</label>
                        <label class="radio-inline"><input type="radio" name="priority" value="Medium" checked>Medium</label>
                        <label class="radio-inline"><input type="radio" name="priority" value="High">High</label>
                    </div>
                    <div class="form-group">
                        <label for="notification">Notification</label>
                        <br>
                        <label class="checkbox-inline"><input type="checkbox" name="notification" value="1">Notify </label>
                    </div>


                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" class="form-control" required \>
                            <option value="" disabled selected> Select Category</option>
                            <?php
                            $query = "select category_id,category_name from category";
                            $result = $crud->getData($query);
                            foreach ($result as $key => $row) {
                                echo "<option value='{$row['category_id']}'> {$row['category_name']}</option>";
                            }
                            ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Related To (hold ctrl to select more than one):</label>
                        <select name="tags[]" multiple required class="form-control">
                            <?php
                            $query = "select tag_name from tags";
                            $result = $crud->getData($query);
                            foreach ($result as $key => $row) {
                                echo "<option value='{$row['tag_name']}'> {$row['tag_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fileToUpload">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->

                <?php

                if (isset($_POST['submit'])) {
                    if ($_FILES['fileToUpload']) {
                        $file_name = $_FILES['fileToUpload']['name'];
                        $file_size = $_FILES['fileToUpload']['size'];
                        $file_tmpname = $_FILES['fileToUpload']['tmp_name'];

                        $arrayext =  explode('.', $file_name);
                        $file_ext = strtolower(end($arrayext));
                        $extensions = array('jpeg', 'png', 'jpg', 'bmp');

                        if (!in_array($file_ext, $extensions)) {
                            echo "<div class='alert alert-danger'>Only jpeg,png,jpg,bmp files are allowed</div>";
                            die();
                        }

                        $post_img = time() . "-" . $file_name;
                        move_uploaded_file($file_tmpname, "upload/" . $post_img) or die('Upload failed');

                        $post_title = $_POST['post_title'];
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
                        $query = "INSERT INTO post(title,date,time,priority,notification,category,tags,post_img) VALUES ('$post_title','$date','$time','$priority','$notification','$categoryid','$tags','$post_img')";
                        $result = $crud->execute($query);
                        if ($result) {
                            $URL = "index.php";
                            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>