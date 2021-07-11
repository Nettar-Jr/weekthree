
<?php 

    
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect('localhost', 'Kelvin', 'Kelvinlocalhost', 'phpsql');

	// If the "if" condition is successful, add item and id to database
	if (isset($_POST['submit'])) {
		if (empty($_POST['item'])) {
			$errors = "You must fill in the task";
		}else{
			$task = htmlspecialchars($_POST['item']);
			$sql = "INSERT INTO `todo list` (Id, Item) VALUES (1, '$task')";
			mysqli_query($db, $sql);
		}
	}

    // A delete button to remove item from database
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];

        $delItem = "DELETE FROM `todo list` WHERE id=".$id;
    
        mysqli_query($db, $delItem);
        // header('location: phpserver.php');
    }

    // edit todo item and update item
    if (isset($_GET['edit_task'])) {
        // task not completed
    
    }
    
?>	

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="php.css">
	<title>ToDo List Application PHP and MySQL</title>
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List</h2>
	</div>
	<form method="post" action="phpserver.php" class="input_form">
		<input type="text" name="item" class="task_input" placeholder="Enter your task...">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>

        <!-- show error bellow input for better user experience -->
        <?php
            if (isset($errors)) { 
        ?>
	    <p style="color:red">
            <?php echo $errors; ?>
        </p>
        <?php } ?>
	</form>  <hr><hr>

    <table>
	<thead>
		<tr>
			<th>ID</td>
			<th>Tasks</th>
			<th></th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select database table if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM `todo list` ");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row["Item"]; ?> </td>
				<td class="edit"> 
					<a href="phpserver.php?edit_task=<?php echo $row['id'] ?>">Edit</a> 
				</td>
                <td class="delete"> 
					<a href="phpserver.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td> 
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>

</body>
</html>
