<!DOCTYPE HTML>
<html>
<head>
    <title>Read Company Info</title>
 
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Read Company Info</h1>
        </div>
 <?php
// use isset() to see if the value is actually there
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'database.php';
 

try {
    $query = "SELECT id, name, description FROM burkewmtest.company WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    $stmt->bindParam(1, $id);
 
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $name = $row['name'];
    $description = $row['description'];
}
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
try {
    $query2 = "SELECT address, address_2, city, state, zip FROM burkewmtest.company_address WHERE id = ? LIMIT 0,1";
    $stmt2 = $con->prepare($query2);

    $stmt2->bindParam(1, $id);

    $stmt2->execute();

    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    $address = $row2['address'];
    $address2 = $row2['address_2'];
	$city = $row2['city'];
	$state = $row2['state'];
	$zip = $row2['zip'];
}

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
    </div> <!-- end .container -->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Name</td>
        <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
    </tr>
	 <tr>
        <td>Address</td>
        <td><?php echo htmlspecialchars($address, ENT_QUOTES);  ?></td>
    </tr>
	<tr>
        <td>Address 2</td>
        <td><?php echo htmlspecialchars($address2, ENT_QUOTES);  ?></td>
    </tr>
	<tr>
        <td>City</td>
        <td><?php echo htmlspecialchars($city, ENT_QUOTES);  ?></td>
    </tr>
	<tr>
        <td>State</td>
        <td><?php echo htmlspecialchars($state, ENT_QUOTES);  ?></td>
    </tr>
	<tr>
        <td>Zip</td>
        <td><?php echo htmlspecialchars($zip, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='index.php' class='btn btn-danger'>Back to Company List</a>
        </td>
    </tr>
</table>
</body>
</html>