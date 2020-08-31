<?php
include('header.php');
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
            <h5 class="modal-title" id="formModalTitle">Update Book Record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
              <input type="hidden" name="editid" id="editid">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Student</label>
                <div class="col-sm-10">
                  <select required id="edit-student" name="student_id" class="custom-select">
                    <option selected disabled>Select Student</option>
                    <?php
                    $query = "select sid,sname from student";
                    $result = $crud->getData($query);
                    foreach ($result as $key => $row) {
                      echo "<option value='{$row['sid']}'> {$row['sname']}</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Book</label>
                <div class="col-sm-10">
                  <select required id="edit-book" name="book_id" class="custom-select">
                    <option selected disabled>Select Book</option>
                    <?php
                    $query = "select bid,bname from book";
                    $result = $crud->getData($query);
                    foreach ($result as $key => $row) {
                      echo "<option value='{$row['bid']}'> {$row['bname']}</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Start Date</label>
                <div class="col-sm-10">
                  <input type="date" name="start_date" id="edit-startdate" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">End Date</label>
                <div class="col-sm-10">
                  <input type="date" name="end_date" id="edit-enddate" class="form-control">
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
            $rent_id = $crud->escape_string(sanitize_input($_POST['editid']));
            $student_id = $crud->escape_string(sanitize_input($_POST['student_id']));
            $book_id = $crud->escape_string(sanitize_input($_POST['book_id']));
            $start_date = $crud->escape_string(sanitize_input($_POST['start_date']));
            $end_date = $crud->escape_string(sanitize_input($_POST['end_date']));

            $query = "UPDATE rent SET sid='$student_id',bid='$book_id',startdate='$start_date',enddate='$end_date' where rid = $rent_id";
            $result = $crud->execute($query);
            if ($result) {
              echo "<script type='text/javascript'>
              alert('Rent Details Updated successfully.');
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
                $rid = $crud->escape_string(sanitize_input($_POST['delete-val']));
                $query = "DELETE FROM rent WHERE rid = $rid";
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

    <div class="col-md-12 mt-5 border pt-3 pb-4">

      <h5 class="mb-4 ">Add Rent Details</h5>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="row no-gutters">
          <div class="col-md-2 ml-md-2">
            <select required name="student_id" class="custom-select">
              <option selected disabled>Select Student</option>
              <?php
              $query = "select sid,sname from student";
              $result = $crud->getData($query);
              foreach ($result as $key => $row) {
                echo "<option value='{$row['sid']}'> {$row['sname']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-2 ml-md-2">
            <select required name="book_id" class="custom-select">
              <option selected disabled>Select Book</option>
              <?php
              $query = "select bid,bname from book";
              $result = $crud->getData($query);
              foreach ($result as $key => $row) {
                echo "<option value='{$row['bid']}'> {$row['bname']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3 ml-md-2">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Start Date</span>
              </div>
              <input required type="date" name="start_date" class="form-control">
            </div>
          </div>
          <div class="col-md-3 ml-md-2">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">End Date</span>
              </div>
              <input required type="date" name="end_date" class="form-control">
            </div>
          </div>
          <div class="col-md-1 ml-md-2">
            <button type="submit" name="submit" class="btn btn-success">Save</button>
          </div>
        </div>
      </form>
      <?php

      if (isset($_POST['submit'])) {

        $student_id = $crud->escape_string(sanitize_input($_POST['student_id']));
        $book_id = $crud->escape_string(sanitize_input($_POST['book_id']));
        $start_date = $crud->escape_string(sanitize_input($_POST['start_date']));
        $end_date = $crud->escape_string(sanitize_input($_POST['end_date']));

        $query = "INSERT INTO rent(sid,bid,startdate,enddate) VALUES ('$student_id','$book_id','$start_date','$end_date')";
        $result = $crud->execute($query);
        if ($result) {
          echo "<script type='text/javascript'>
          alert('Rent Details Saved successfully.');
          </script>";
          $_POST = array();
          // $URL = "student.php";
          // header('Location:' . $URL);
        }
      }

      ?>
    </div>
  </div>

  <div class="table-responsive-md mt-3 border p-0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Book Name</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $query = "SELECT rent.rid,rent.startdate,rent.enddate,student.sname,book.bname FROM rent
        LEFT JOIN student ON student.sid = rent.sid
        LEFT JOIN book ON book.bid = rent.bid
        ORDER BY rent.startdate DESC";
        $result = $crud->getData($query);
        foreach ($result as $key => $row) {
          echo "<tr>
          <td>{$row['sname']}</td>
          <td>{$row['bname']}</td>
          <td>{$row['startdate']}</td>
          <td>{$row['enddate']}</td>
          <td><a href='#' id='{$row['rid']}' onclick='editModal(this.id)'  class='btn btn-info'>Edit</a></td>
          <td><a href='#' id='{$row['rid']}' onclick='deleteModal(this.id)' class='btn btn-danger'>Delete</a></td>
        </tr>";
        }
        ?>

      </tbody>
    </table>
  </div>
</div>

<script>
  function deleteModal($this) {
    $('#delete-val').val($this)
    $('#deleteModal').modal('show')
  }

  function editModal($this) {
    // $('#editModal').modal('show')
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        dataType: 'json',
        data: {
          id: $this,
          type: 'rent'
        },
      })
      .done(function(data) {
        $('#editid').val(data.rid);
        $('#edit-student option[value=' + data.sid + ']').attr('selected', 'selected');
        $('#edit-book option[value=' + data.bid + ']').attr('selected', 'selected');
        $('#edit-startdate').val(data.startdate);
        $('#edit-enddate').val(data.enddate);
        $('#editModal').modal('show')
        // alert("Posting success. " + data);
      })
      .fail(function() {
        alert("Update failed.");
      });
  }
</script>
<?php
include('footer.php');
?>