<?php

$con = mysqli_connect("slimeyeats-do-user-8896225-0.b.db.ondigitalocean.com", "doadmin", "c03hefu7f7l8ote3", "slimeyEats",25060);

//check that connect hapen

if(mysqli_connect_errno()){
    echo "1: connection failed"; //error code #1 = connection failed
    exit();
}

$username = $_POST["name"];
$newInventory = $_POST["inventory"];

//double check is only user with this name
$namecheckquery = "SELECT username FROM slimeyEatsDB WHERE username = '".$username."';";

$namecheck = mysqli_query($con, $namecheckquery) or die("2: name check query failed"); //error code #2 - name check query failed

if (mysqli_num_rows($namecheck) != 1){
    echo "5: Either no user with name or more than one"; //error code #5 - Either no user with name or more than one
    exit();
}

$updatequery = "UPDATE slimeyEatsDB SET inventory = '" . $newInventory . "' WHERE username ='".$username ."';";

mysqli_query($con,$updatequery) or die("7: Save query failed"); //error code #7 - update query failed

echo "0";

?>