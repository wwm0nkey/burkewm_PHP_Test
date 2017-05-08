<!DOCTYPE HTML>
<html>
<head>
    <title>Create Company</title>
     
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Create Company Record</h1>
        </div>
     
    <!-- dynamic content will be here -->
          <?php
if($_POST){
 
    // include database connection
    include 'database.php';
 
    try{
     
        // insert query
        $query = "INSERT INTO burkewmtest.company SET name=:name, description=:description";
        // prepare query for execution
        $stmt = $con->prepare($query);
		
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
 
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        
        
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
			$results = $stmt->FetchALL(PDO::FETCH_ASSOC);
			$json=json_encode($results);
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
	
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
	    try{
     
        // insert query
        $query2 = " INSERT INTO burkewmtest.company_address SET company_id=:company_id, address=:address, address_2=:address_2, city=:city, state=:state, zip=:zip";
        // prepare query for execution
		$stmt2 = $con->prepare($query2);
 
        // posted values
		$company_id=htmlspecialchars(strip_tags($_POST['company_id']));
		$address=htmlspecialchars(strip_tags($_POST['address']));
		$address2=htmlspecialchars(strip_tags($_POST['address_2']));
		$city=htmlspecialchars(strip_tags($_POST['city']));
		$state=htmlspecialchars(strip_tags($_POST['state']));
		$zip=htmlspecialchars(strip_tags($_POST['zip']));
 
        // bind the parameters
		$stmt2->bindParam(':company_id', $company_id);
		$stmt2->bindParam(':address', $address);
		$stmt2->bindParam(':address_2', $address2);
		$stmt2->bindParam(':city', $city);
		$stmt2->bindParam(':state', $state);
		$stmt2->bindParam(':zip', $zip);
        
       
         
        // Execute the query
        if($stmt2->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         $results = $stmt2->FetchALL(PDO::FETCH_ASSOC);
		 $json=json_encode($results);
    }
	
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
    </div> 
	<!-- end .container -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	<tr>
            <td>Company ID</td>
            <td><input type='text' name='company_id' class='form-control' /></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>address</td>
            <td><input type='text' name='address' class='form-control' /></td>
        </tr>
		<tr>
            <td>address 2</td>
            <td><input type='text' name='address_2' class='form-control' /></td>
        </tr>
		<tr>
            <td>City</td>
            <td><input type='text' name='city' class='form-control' /></td>
        </tr>
		<tr>
            <td>State</td>
            <td><input type='text' name='state' class='form-control' /></td>
        </tr>
		<tr>
            <td>Zip</td>
            <td><input type='text' name='zip' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to Company List</a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>