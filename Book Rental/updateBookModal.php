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


                        <!-- </form> -->
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
                        echo "<script type='text/javascript'>alert('Book Details Updated successfully.');</script>";
                        $_POST = array();
                        // $URL = "student.php";
                        // header('Location:' . $URL);
                    }
                }

                ?>

            </div>
        </div>
    </div>
    <!-- Edit Modal End -->