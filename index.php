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

$id = '';
$name = '';
$age = '';

if(isset($_GET['flag'])){
    $flag = $_GET['flag'];

    if($flag == 1){
        $id = $_GET['id'];
        
        $result = mysqli_query($con,"SELECT * FROM users WHERE id = '$id'");

        if(mysqli_num_rows($result) != 0){
            $selectedUser = mysqli_fetch_array($result); 
            $name = $selectedUser['name'];
            $age = $selectedUser['age'];
        }
        
    }else if($flag == 2){
        $id = $_GET['id'];
                    
        $deleteUser = mysqli_query($con,"DELETE FROM users WHERE id = '$id'");
        if($deleteUser){
            echo "Record deleted successfully";
        }else{
            echo "Error: ". mysqli_error($con);
        } 
    }

}

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];

    
    $updateUser = mysqli_query($con,"UPDATE users SET name = '$name', age = '$age' WHERE id = '$id'");
    if($updateUser){
        echo "Record Updated successfully";
    } else {
        echo "Error: ". mysqli_error($con);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>CREATE Operation</title>
</head>


<body>
    <h1>Create Operation</h1>
    <form action="index.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $age; ?>" required><br><br>


        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="update" value="Update">
    </form>

    <hr>

    <h1>Read Operation</h1>

    <table class="table table-striped" style="width: 80%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $result = mysqli_query($con,"SELECT * FROM users");

                if(mysqli_num_rows($result) != 0){

                    $count = 0;

                    while($users = mysqli_fetch_array($result)){
                        $count++;
                        echo "<tr>
                                <td>".$count."</td>
                                <td>".$users['name']."</td>
                                <td>".$users['age']."</td>
                                <td>
                                    <a href='index.php?id=".$users['id']."&flag=1' class='btn btn-primary'>Edit</a>
                                    <button id='deleteID' onclick='deleteUser()' value=".$users['id']." class='btn btn-danger'> Delete </button>
                                </td>
                        </tr>";
                    }

                }else{
                    echo "<tr>
                            <td colspan='4'>No Records Found</td>
                        </tr>";
                } 

                // <a href='index.php?id=".$users['id']."&flag=2'  class='btn btn-danger'>Delete</a>


            ?>
        </tbody>
    </table>



</body>

<script>
        function deleteUser(){
            var id = document.getElementById("deleteID").value;

            console.log(id);
            if (confirm("Are you sure?") == true) {
                window.location.href = "index.php?id="+id+"&flag=2";
            } else {
                // Canceled the request
            }
        }
    </script>
</html>