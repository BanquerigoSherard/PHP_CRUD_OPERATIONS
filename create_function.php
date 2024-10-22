<?php

include('dbConnect.php');

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $age = $_POST['age'];

    
    $insertNewUser = mysqli_query($con,"INSERT INTO users (name, age) VALUES('$name', '$age')");

    if($insertNewUser){
        echo "New record created successfully";
    } else {
        echo "Error: ". mysqli_error($con);
    }
}


?>