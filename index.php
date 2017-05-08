<!DOCTYPE HTML>
<html>
<head>
    <title>Read Company Info</title>
     
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
    <style>
    
    </style>
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
	        <div class="page-header">
            <h1>Company List</h1>
        </div>
  <?php
// include database connection
include 'database.php';
 $action = isset($_GET['action']) ? $_GET['action'] : "";
 
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
$query = "SELECT id, name, description FROM burkewmtest.company ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();
 
//Get number of rows 
$num = $stmt->rowCount();
 
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Company</a>";
 
//Make sure more than 1 record is found
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";//start table
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th>Action</th>";
        echo "</tr>";
         
        // retrieve the tables
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
             
            // creating table per record
            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$description}</td>";
                echo "<td>";
                    // read one record 
                    echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
                     
                    echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
 
                    echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
                echo "</td>";
            echo "</tr>";
        }
     
    echo "</table>";
     
}
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>     
    </div> <!-- end .container -->
     
 <script type='text/javascript'>
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
		//Will delete if user clicks OK
        window.location = 'delete.php?id=' + id;
    } 
}
</script>
</body>
</html>