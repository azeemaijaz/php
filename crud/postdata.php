<?php
include "header.php";
require_once("classes/Crud.php");
$crud = new Crud();
?>
<div id="admin-content">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form  action='json.php' method='post' enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Post Title</label>
                        <input type="text" name="title" class="form-control" autocomplete="off" required \>
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
                    <input type="submit" name="submit" class="btn btn-primary" value="Send to json.php" required />
                    <input type="button" id="btn" class="btn btn-success" value="Send using ajax" />
                </form>
                <!--/Form -->
                <script src="js/jquery.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#btn').click(function() {
                            $.ajax({
                                    type: 'POST',
                                    url: 'ajax.php',
                                    data: $('form').serialize()
                                })
                                .done(function(data) {
                                    alert("Posting success. " + data);

                                })
                                .fail(function() {
                                    alert("Posting failed.");
                                });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>