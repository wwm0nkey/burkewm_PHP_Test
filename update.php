<!DOCTYPE HTML>
<html>
<head>
    <title>Update Company Info</title>
     
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Company</h1>
        </div>
    
 <?php
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID was not found.');
 
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
    $query2 = "SELECT company_id, address, address_2, city, state, zip FROM burkewmtest.company_address WHERE id = ? LIMIT 0,1";
    $stmt2 = $con->prepare( $query2 );
     
    $stmt2->bindParam(1, $id);
     
    $stmt2->execute();
     
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
     
	$company_id = $row2['company_id'];
    $address = $row2['address'];
    $address_2 = $row2['address_2'];
	$city = $row2['city'];
	$state = $row2['state'];
	$zip = $row2['zip'];
}
 
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
    </div> 
	<!-- end .container -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
        </tr>
				<tr>
            <td>company id</td>
            <td><textarea name='company_id' class='form-control'><?php echo htmlspecialchars($company_id, ENT_QUOTES);  ?></textarea></td>
        </tr>
		        <tr>
            <td>address</td>
            <td><textarea name='address' class='form-control'><?php echo htmlspecialchars($address, ENT_QUOTES);  ?></textarea></td>
        </tr>
		        <tr>
            <td>address 2</td>
            <td><textarea name='address_2' class='form-control'><?php echo htmlspecialchars($address_2, ENT_QUOTES);  ?></textarea></td>
        </tr>
		        <tr>
            <td>city</td>
            <td><textarea name='city' class='form-control'><?php echo htmlspecialchars($city, ENT_QUOTES);  ?></textarea></td>
        </tr>
		        <tr>
            <td>state</td>
            <td><textarea name='state' class='form-control'><?php echo htmlspecialchars($state, ENT_QUOTES);  ?></textarea></td>
        </tr>
		        <tr>
            <td>zip</td>
            <td><textarea name='zip' class='form-control'><?php echo htmlspecialchars($zip, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to Company List</a>
            </td>
        </tr>
    </table>
</form>
<?php

$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
include 'database.php';
 
// Make sure form was submitted
if($_POST){
     
    try{
     
        $query = "UPDATE burkewmtest.company 
                    SET name=:name, description=:description
                    WHERE id = :id";
 

        $stmt = $con->prepare($query);
 
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
 
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
         
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Company was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Could not update Company. Try again.</div>";
        }
         
    }
     
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
	try{
     
        $query2 = "UPDATE burkewmtest.company_address
                    SET company_id=:company_id, address=:address, address_2=:address_2, city=:city, state=:state, zip=:zip
                    WHERE id =:id";
 

        $stmt2 = $con->prepare($query2);
 
		$company_id=htmlspecialchars(strip_tags($_POST['company_id']));
        $address=htmlspecialchars(strip_tags($_POST['address']));
        $address_2=htmlspecialchars(strip_tags($_POST['address_2']));
		$city=htmlspecialchars(strip_tags($_POST['city']));
		$state=htmlspecialchars(strip_tags($_POST['state']));
		$zip=htmlspecialchars(strip_tags($_POST['zip']));
 
		$stmt2->bindParam(':company_id', $company_id);
        $stmt2->bindParam(':address', $address);
        $stmt2->bindParam(':address_2', $address_2);
        $stmt2->bindParam(':city', $city);
		$stmt2->bindParam(':state', $state);
		$stmt2->bindParam(':zip', $zip);
         
        if($stmt2->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

</body>
</html>