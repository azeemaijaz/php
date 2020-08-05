<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Post Comments</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <style>
         body{margin-top:40px;}
         .cmt-wrapper .panel-body {         
         overflow:auto;
         }
        
         .cmt-wrapper .media-list .media {
         border-bottom:1px solid #efefef;
         margin-bottom:25px;
         }
         
      </style>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-md-8 col-sm-12">
            	
            	<div class="panel panel-info">
                     <div class="panel-heading">
                        <b>Post a Comment</b>
                     </div>
                     <?php
					require_once("classes/Test.php");
					$test = new Test();
					error_reporting(0); 
					?>
						
                     <div class="panel-body">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" >
                           <div class="form-group">
                              <label  for="name">Name:</label>
                              <input type="text" class="form-control" required name="name" placeholder="Name" >
                           </div>
                           <div class="form-group">
                              <label for="email">Email address:</label>
                              <input type="email" class="form-control" required name="email" placeholder="Email Address" >
                           </div>
                           <div class="form-group">
                              <label for="comment">Comment:</label>
                              <textarea name="comment" maxlength="250" required  class="form-control" placeholder="Write a comment..." rows="3"></textarea>
                           </div>
                           <div id="alert"></div>
                           <button type="submit" name="submit" class="btn btn-info pull-right">Post Comment</button>
                           <div class="clearfix"></div>
                        </form>
                        </div>
                   </div>
                   <?php
                    function sanitize_input($data) {
 					 $data = trim($data);
					  $data = stripslashes($data);
  					$data = htmlspecialchars($data);
 					 return $data;
 					}
 
                if (isset($_POST['submit'])){
                	date_default_timezone_set('Asia/Kolkata');
                     $timestamp = date("d-M-y,h:i A");
					 $name = $test->escape_string(sanitize_input($_POST['name']));
                     $email = $test->escape_string(sanitize_input($_POST['email']));
                     $comment = $test->escape_string(sanitize_input($_POST['comment']));
   
						$query = "INSERT INTO comments(timestamp,name,email,comment) VALUES ('$timestamp','$name','$email','$comment')";
						$result = $test->execute($query);
                      if ($result) {        
                            echo " <script type='text/javascript'>alert('Comment posted successfully');</script>";
                    }               
                    }
                ?>
               <div class="cmt-wrapper">
                  <div class="panel panel-info">
                     <div class="panel-heading">
                        <b> Comments </b>
                     </div>
                     
                     <div class="panel-body">                     
                        
                        <ul class="media-list">
                           
                           <?php
             			 $query = "SELECT * FROM comments";
               			$result = array_reverse($test->getData($query));
                          foreach ($result as $key => $row) {     
                          ?>
							<li class="media">
                              <strong class="text-primary"><?php echo $row['name']; ?></strong>
                              <span class="text-muted pull-right">
                              <small class="text-muted"><?php echo $row['timestamp']; ?></small>
                              </span>
                              <br>
                              <small class="text-success"><i><?php echo $row['email']; ?></i></small>
                              <div class="media-body">
                                 <p><?php echo $row['comment']; ?></p>
                              </div>
                           </li>
                           <?php
                        }
                        ?>
                           
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
   </body>
</html>