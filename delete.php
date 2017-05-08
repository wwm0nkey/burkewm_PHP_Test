<?php
// include database connection
include 'database.php';
 
try {
     
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    $query = "DELETE FROM burkewmtest.company WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
     
    if($stmt->execute()){
        header('Location: index.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
try {

    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    $query2 = "DELETE FROM burkewmtest.company_address WHERE id = ?";
    $stmt2 = $con->prepare($query2);
    $stmt2->bindParam(1, $id);
     
    if($stmt2->execute()){
        header('Location: index.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}
 
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>