<?php
include('header.php');
require_once("classes/Crud.php");
$crud = new Crud();
?>


<div class="container">
  <div class="row justify-content-center">


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
                $bid = $crud->escape_string(sanitize_input($_POST['delete-val']));
                $query = "DELETE FROM book WHERE bid = $bid";
                $result = $crud->execute($query);
                if ($result) {
                  echo "<script type='text/javascript'> 
                  alert('Record Deleted Successfully.');
                  $('#deleteModal').modal('hide');
                  </script>";
                  // $_POST = array();
                }
              }

              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--delete Modal End -->


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
                <label for="Name" class="col-sm-2 col-form-label">Book Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="editname" name="name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="Author" class="col-sm-2 col-form-label">Book Author</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="editauthor" name="author" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="publication" class="col-sm-2 col-form-label">Publication</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="editpublication" name="publication" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="Year" class="col-sm-2 col-form-label">Year</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="edityear" name="year" required>
                </div>
              </div>
              <!-- </> -->
          </div>
          <div class="modal-footer">
            <button type="submit" name="editsubmit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
          </form>
          <?php

          if (isset($_POST['editsubmit'])) {

            $book_id = $crud->escape_string(sanitize_input($_POST['editid']));
            $book_name = $crud->escape_string(sanitize_input($_POST['name']));
            $book_author = $crud->escape_string(sanitize_input($_POST['author']));
            $book_publication = $crud->escape_string(sanitize_input($_POST['publication']));
            $book_year = $crud->escape_string(sanitize_input($_POST['year']));

            $query = "UPDATE book SET bname='$book_name',bauthor='$book_author',bpublication='$book_publication',byear='$book_year' where bid = $book_id";
            $result = $crud->execute($query);
            if ($result) {
              echo "<script type='text/javascript'>
              alert('Book Details Updated successfully.');
              $('#editModal').modal('hide');
              </script>";
            }
          }

          ?>

        </div>
      </div>
    </div>
    <!-- Edit Modal End -->

    <!-- Form -->
    <div class="col-md-10 mt-3 border pt-3">
      <h5 class="mb-4 ">Add Book Details</h5>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="form-group row">
          <label for="Name" class="col-sm-2 col-form-label">Book Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="Author" class="col-sm-2 col-form-label">Book Author</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="author" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="publication" class="col-sm-2 col-form-label">Publication</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="publication" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="Year" class="col-sm-2 col-form-label">Year</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="year" required>
          </div>
        </div>

        <div class="form-group row mt-4">
          <div class="col-12 ml-auto ">
            <div class="row justify-content-center">
              <button type="submit" name="submit" class="btn btn-success">Save</button>
              <button type="submit" class="ml-3 btn btn-dark">Cancel</button>
            </div>
          </div>
        </div>
      </form>
      <?php

      if (isset($_POST['submit'])) {

        $book_name = $crud->escape_string(sanitize_input($_POST['name']));
        $book_author = $crud->escape_string(sanitize_input($_POST['author']));
        $book_publication = $crud->escape_string(sanitize_input($_POST['publication']));
        $book_year = $crud->escape_string(sanitize_input($_POST['year']));

        $query = "INSERT INTO book(bname,bauthor,bpublication,byear) VALUES ('$book_name','$book_author','$book_publication','$book_year')";
        $result = $crud->execute($query);
        if ($result) {
          echo "<script type='text/javascript'>alert('Book Details Saved successfully.');</script>";
          $_POST = array();
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
          <th>Book Name</th>
          <th>Book Author</th>
          <th>Publication</th>
          <th>Year</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $query = "select * from book ORDER BY bid DESC";
        $result = $crud->getData($query);
        foreach ($result as $key => $row) {
          echo "<tr>
          <td>{$row['bname']}</td>
          <td>{$row['bauthor']}</td>
          <td>{$row['bpublication']}</td>
          <td>{$row['byear']}</td>
          <td><a href='#' id='{$row['bid']}' onclick='editModal(this.id)'  class='btn btn-info'>Edit</a></td>
          <td><a href='#' id='{$row['bid']}' onclick='deleteModal(this.id)' class='btn btn-danger'>Delete</a></td>
        </tr>";
        }
        ?>

      </tbody>
    </table>
  </div>
  <!-- END Table -->

</div>
<script>
  function deleteModal($this) {
    $('#delete-val').val($this)
    $('#deleteModal').modal('show')
  }

  function editModal($this) {

    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        dataType: 'json',
        data: {
          id: $this,
          type: 'book'
        },
      })
      .done(function(data) {
        $('#editid').val(data.bid);
        $('#editname').val(data.bname);
        $('#editauthor').val(data.bauthor);
        $('#editpublication').val(data.bpublication);
        $('#edityear').val(data.byear);
        $('#editModal').modal('show')

        // alert("Posting success. " + data.bid);

      })
      .fail(function() {
        alert("Update failed.");
      });
  }
</script>
<?php
include('footer.php');
?>