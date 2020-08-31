<?php
include "header.php";
require_once("classes/Crud.php");
$crud = new Crud();
?>
<div class="container">
  <div class="row justify-content-center">

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formModalTitle">Update Rent Record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="editid" id="editid">
              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="edit-name" name="name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="class" class="col-sm-2 col-form-label">Class</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="edit-class" name="class" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                <div id="edit-photo-div" class="col-sm-10">
                  <div class="custom-file">
                    <label class="custom-file-label" for="customFile">Update Photo</label>
                    <input type="file" id="edit-photofile" name="photofile" accept="image/*" class="custom-file-input">
                  </div>
                  <img id="edit-photo" class="img-fluid mt-1" width="105px" alt="image">
                </div>
              </div>
              <div class="form-group row">
                <label for="video" class="col-sm-2 col-form-label">Video</label>
                <div id="edit-video-div" class="col-sm-10">
                  <div class="custom-file">
                    <label class="custom-file-label" for="customFile">Update Video</label>
                    <input type="file" id="edit-videofile" name="videofile" accept="video/*" class="custom-file-input">
                  </div>
                  <video id="edit-video" width='150px' height='100px' controls type='video/mp4'></video>
                </div>
              </div>

              <!-- </form> -->
          </div>
          <div class="modal-footer">
            <button type="submit" name="editsubmit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
          </form>
          <?php
          if (isset($_POST['editsubmit'])) {
            if (!empty($_FILES['photofile']['name'])) {
              $photo_file_name = $_FILES['photofile']['name'];
              $photo_file_tmpname = $_FILES['photofile']['tmp_name'];
              $student_photo = time() . "-" . $photo_file_name;
              move_uploaded_file($photo_file_tmpname, "s_photos/" . $student_photo) or die('Upload failed');
              $photo_file_query = ",sphoto='$student_photo'";
            } else {
              $photo_file_query = '';
            }
            if (!empty($_FILES['videofile']['name'])) {
              $video_file_name = $_FILES['videofile']['name'];
              $video_file_tmpname = $_FILES['videofile']['tmp_name'];
              $student_video = time() . "-" . $video_file_name;
              move_uploaded_file($video_file_tmpname, "s_videos/" . $student_video) or die('Upload failed');
              $video_file_query = ",svideo='$student_video'";
            } else {
              $video_file_query = '';
            }
            $student_id = $crud->escape_string(sanitize_input($_POST['editid']));
            $student_name = $crud->escape_string(sanitize_input($_POST['name']));
            $student_class = $crud->escape_string(sanitize_input($_POST['class']));
            $query = "UPDATE student SET sname='$student_name',sclass='$student_class' $photo_file_query $video_file_query where sid = $student_id";
            $result = $crud->execute($query);
            if ($result) {
              echo "<script type='text/javascript'>
             alert('Student Details Updated successfully.');
              $('#editModal').modal('hide');
              </script>";
            }
          }

          ?>

        </div>
      </div>
    </div>
    <!-- Edit Modal End -->

    <!--delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h6>Do you really want to delete this record?</h6>
          </div>
          <div class="modal-footer">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
              <input type="hidden" id="delete-val" name="delete-val">
              <button type="submit" name="delete-btn" class="btn btn-danger">Yes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <?php
              if (isset($_POST['delete-btn'])) {
                $sid = $crud->escape_string(sanitize_input($_POST['delete-val']));

                $query = "select sphoto,svideo from student WHERE sid = $sid";
                $result = $crud->getData($query);
                unlink("s_photos/" . $result[0]['sphoto']);
                unlink("s_videos/" . $result[0]['svideo']);
                $query = "DELETE FROM student WHERE sid = $sid";
                $result = $crud->execute($query);
                if ($result) {
                  echo "<script type='text/javascript'>
                alert('Record Deleted Successfully.');
                $('#deleteModal').modal('hide');
                </script>";
                }
              }

              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--delete Modal End -->

    <!-- Form -->
    <div class="col-md-10 mt-3 border pt-3">
      <h5 class="mb-4 ">Add Student Details</h5>
      <!-- <iframe src="s_videos/1597403666-count.mp4" width="540" height="310"></iframe>s -->
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="class" class="col-sm-2 col-form-label">Class</label>
          <div class="col-sm-10">
            <input id="class" type="text" class="form-control" name="class" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="photo" class="col-sm-2 col-form-label">Photo</label>
          <div id="photo-div" class="col-sm-10">
            <div class="custom-file">
              <label class="custom-file-label" for="customFile">Choose Photo</label>
              <input type="file" accept="image/*" class="custom-file-input" name="photofile">
            </div>
            <img class="d-none img-fluid mt-1" width="105px" alt="image">
          </div>
        </div>
        <div class="form-group row">
          <label for="video" class="col-sm-2 col-form-label">Video</label>
          <div id="video-div" class="col-sm-10">
            <div class="custom-file">
              <label class="custom-file-label" for="customFile">Choose Video</label>
              <input type="file" accept="video/mp4" id="videofile" class="custom-file-input" name="videofile">
            </div>
            <video class="d-none" width='150px' height='100px' controls type='video/mp4'></video>
          </div>
        </div>
        <div class="form-group row mt-4">
          <div class="col-12 ml-auto ">
            <div class="row justify-content-center">
              <button type="submit" name='submit' class="btn btn-success">Save</button>
              <button type="button" class="ml-3 btn btn-dark">Cancel</button>
            </div>
          </div>
        </div>
      </form>
      <?php

      if (isset($_POST['submit'])) {
        if (!empty($_FILES['photofile']['name'])) {
          $photo_file_name = $_FILES['photofile']['name'];
          $photo_file_tmpname = $_FILES['photofile']['tmp_name'];
          $student_photo = time() . "-" . $photo_file_name;
          move_uploaded_file($photo_file_tmpname, "s_photos/" . $student_photo) or die('Upload failed');
        } else {
          echo "<script type='text/javascript'>alert('Please select a photo.')</script>";
          die();
        }
        if (!empty($_FILES['videofile']['name'])) {
          $video_file_name = $_FILES['videofile']['name'];
          $video_file_tmpname = $_FILES['videofile']['tmp_name'];
          $student_video = time() . "-" . $video_file_name;
          move_uploaded_file($video_file_tmpname, "s_videos/" . $student_video) or die('Upload failed');
        } else {
          echo "<script type='text/javascript'>alert('Please select a video.')</script>";
          die();
        }

        $student_name = $crud->escape_string(sanitize_input($_POST['name']));
        $student_class = $crud->escape_string(sanitize_input($_POST['class']));

        $query = "INSERT INTO student(sname,sclass,sphoto,svideo) VALUES ('$student_name','$student_class','$student_photo','$student_video')";
        $result = $crud->execute($query);
        if ($result) {
          echo "<script type='text/javascript'>alert('Student Details Saved successfully.');</script>";
          // $_POST = array();
          // $URL = "student.php";
          // header('Location:' . $URL);
        }
      }

      ?>
    </div>
  </div>
  <!-- END Form -->


  <!-- Table -->
  <div class="col-md-10 mx-auto table-responsive-md mt-3 border p-0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Student Class</th>
          <th>Student Photo</th>
          <th>Student Video</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "select * from student ORDER BY sid DESC";
        $result = $crud->getData($query);
        foreach ($result as $key => $row) {
          echo "<tr>
          <td>{$row['sname']}</td>
          <td>{$row['sclass']}</td>
          <td><img height='80px' width='100px' src='s_photos/{$row['sphoto']}' alt=''/> </td>
          <td class='p-0'><video width='150px' height='100px' controls src='s_videos/{$row['svideo']}' type='video/mp4'></video></td>
          <td><a href='#' id='{$row['sid']}' onclick='editModal(this.id)'  class='btn btn-info'>Edit</a></td>
          <td><a href='#' id='{$row['sid']}' onclick='deleteModal(this.id)' class='btn btn-danger'>Delete</a></td>
        </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <!-- END Table -->
</div>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
  function deleteModal($this) {
    $('#delete-val').val($this)
    $('#deleteModal').modal('show')
  }

  $(document).on("change", "#edit-photo-div input ", function(evt) {
    $('#edit-photo-div label').text(this.value.split('\\').pop());
    var $source = $('#edit-photo-div img');
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
  });

  $(document).on("change", "#edit-video-div input", function(evt) {
    $('#edit-video-div label').text(this.value.split('\\').pop());
    var $source = $('#edit-video-div video');
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
  });
  $(document).on("change", "#photo-div input ", function(evt) {
    $('#photo-div label').text(this.value.split('\\').pop());
  });

  $(document).on("change", "#video-div input", function(evt) {
    $('#video-div label').text(this.value.split('\\').pop());
  });

  function editModal($this) {

    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        dataType: 'json',
        data: {
          id: $this,
          type: 'student'

        },
      })
      .done(function(data) {
        $('#editid').val(data.sid);
        $('#edit-name').val(data.sname);
        $('#edit-class').val(data.sclass);
        $('#edit-photo').attr('src', 's_photos/' + data.sphoto);
        $('#edit-video').attr('src', 's_videos/' + data.svideo);
        // $('#edit-videofile').val(data.svideo);
        $('#editModal').modal('show')
        // alert("Posting success. " + data.sphoto);

      })
      .fail(function() {
        alert("Update failed.");
      });
  }
</script>
</body>

</html>