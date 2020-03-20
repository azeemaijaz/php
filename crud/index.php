<?php
include "header.php";
require_once("classes/Crud.php");
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Records</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add.php">add record</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Priority</th>
                        <th>Notification</th>
                        <th>Related To</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        $crud = new Crud();
                        //fetching data in descending order (lastest entry first)
                        $query = "select post.post_id,post.title,post.priority,post.notification,post.tags,post.date,post.time,category.category_name from post 
                            join category on post.category = category.category_id
                             ORDER BY post.post_id DESC";
                        $result = $crud->getData($query);
                        $c = 0;

                        foreach ($result as $key => $row) {
                            $c++;
                            $notification = 'No';
                            if ($row['notification'] != 0) {
                                $notification = 'Yes';
                            }
                            echo "<tr>
                             <td class='id'>{$c}</td>
                             <td>{$row['title']}</td>
                             <td>{$row['category_name']}</td>
                             <td>{$row['date']}</td>
                             <td>{$row['time']}</td>
                             <td>{$row['priority']}</td>
                             <td>{$notification}</td>
                             <td>{$row['tags']}</td>
                             <td class='edit'><a href='update.php?pid={$row['post_id']}' ><i class='fa fa-edit'></i></a></td>
                             <td class='delete'><a href='delete.php?pid={$row['post_id']}'><i class='fa fa-trash-o'></i></a></td>
                         </tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>