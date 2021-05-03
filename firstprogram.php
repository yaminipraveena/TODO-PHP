<?php
    // initialize errors variable
    $errors ="";
    //connect to database
    $db = mysqli_connect("localhost","root","","todo");
    //insert a quote if submit button is clicked

    if (isset($_POST['submit'])) {
     		if(empty($_POST['task'])){
     			$errors = "you must fill in the task";
     		}else{
     			$task = $_POST['task'];
     		    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
     		    mysqli_query($db, $sql);
     		    header('location: firstprogram.php');
     	}

    }
    
    // Initialising a DateTime
   /* $datetime = new DateTime('2019-09-30');
 
    $datetime->add(new DateInterval('PT5H3M10S'));
  
    echo $datetime->format('Y-m-d H:i:s') . "\n";*/
        //delete task
    if(isset($_GET['del_task'])) {
     	$id=($_GET['del_task']);
     	mysqli_query($db,"DELETE FROM tasks WHERE id=".$id);
     	header('location: firstprogram.php');
    }

    if(isset($_GET['del_task']))
      {
        $id=$_GET['del_task'];
        $query1=mysqli_query($db,"delete from addd where id='$id'");
        if($query1)
          {
          header('location:firstprogram.php');
          }
      }
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Todo list application with php </title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="heading">
		<h2 style="font-style:'Hervetica';"> Todo list application with php</h2>
	</div>
	<form method="post" action="firstprogram.php" class="input_form">
		<input type="text" name="task" class="task_input">
		<button type="submit" class="add-btn" name="submit" id="add-btn"></a> Add Task</button>
		<?php if(isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>	
		
	</form>
	<table>
		<thead>
			<th>N</th>
			<th>status</th>
			<th>tasks</th>
			<th>dateandtime</th>
			<th> due date</th>
			<th style="width: 60px;">action</th>


		</thead>
		<tbody>
			
		<?php
		$tasks = mysqli_query($db, "SELECT * FROM tasks");
		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
		
		    <tr>

				<td><?php echo $i; ?> </td>
			    <td>

		 	     <button class="btn btn-success">
			      <!--<i class="fa fa-check"></i>-->
			       completed
			       </button>  
		        </td>
				<td class="task"><?php echo $row['task']; ?>
				</td>  
				<td> <?php
                       $nextWeek = time() + (7 * 24 * 60 * 60);
                        // 7 days; 24 hours; 60 mins; 60secs
                         echo " ".date('Y-m-d (h-m)') ."\n";?>
                </td>
                <td><?php
                          // or using strtotime():
                         echo  " ".date('Y-m-d (h-m)', strtotime('+1 week')) ."\n";
                       ?>
                </td>
                <td class="delete">
                	<a href="javascript: delete_user(<?php echo $row['id']; ?>)">x</a>
                	<a href="firstprogram.php?del_task=<?php echo $row['id'] ?>">x</a>
                </td>
				</td>
				
			</tr>
		<?php $i++; } ?>
		</tbody>
	</table>
</body>
<script>
function delete_user(uid)
    {
      if (confirm('Are You Sure to Delete this Record?'))
      {
            window.location.href = 'firstprogram.php?id=' + uid;
      }
        
    }
</script>


<!--add onclick event-->

</html>