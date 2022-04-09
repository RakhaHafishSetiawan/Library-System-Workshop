
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Nama</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	<?php include "menu.php"; 
	# Include script to make a database connection
	include("connect.php");
	# Empty string to be used later
	$id=$_GET["id"];
	$name='';
	$email='';


	# Button click to update using POST method
	if(!empty($id)){
	  
	  # Fetch record with ID and populate it in the form
	  $query2 = "SELECT * FROM user WHERE id='".$id."' ";
	  $result = $conn->query($query2);
	  if ($result->num_rows > 0) {
		# Output data for each row
		while($row = $result->fetch_assoc()) {
		  $name=$row["name"];
		  $email=$row["email"];
		}
	  } else {
		echo "Terjadi Kesalahan saat update";
	  }
	}

	# Check that the input fields are not empty and process the data
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['id']) ){
		# Insert into the database
	  $query = "UPDATE user SET name='".$_POST['name']."', email='".$_POST['email']."' WHERE id='".$_POST['id']."' ";
	  if (mysqli_query($conn, $query)) {
		  # echo "Record updated successfully!<br/>";
		  header('location:data-nama.php');
		  die(0);
	  } else {
		  # Display an error message if unable to update the record
		   echo "Terjadi Kesalahan saat update: " . $conn->error;
		   die(0);
	  }
	}
	?>
    <h1>Edit Data</h1>
    <form method="POST" action="update-nama.php">
		<input type="text" name="id" value="<?php echo($id); ?>" hidden>
        Name: <input type="text" name="name" value="<?php echo($name); ?>" required><br><br/>
        Email: <input type="text" name="email" value="<?php echo($email); ?>" required><br/>
        <br/>
        <input class="btn btn-success" type="submit" value="update">
    </form>
	</div>
</body>
</html>
