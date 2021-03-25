<?php  
    $con = mysqli_connect("slimeyeats-do-user-8896225-0.b.db.ondigitalocean.com", "doadmin", "c03hefu7f7l8ote3", "slimeyEats",25060);

    //check that connect hapen

    if(mysqli_connect_errno()){
        echo "1: connection failed"; //error code #1 = connection failed
        exit();
    }

    $username = $_POST["name"];
    $password = $_POST["password"];

    //check if name taken

    $namecheckquery = "SELECT username FROM slimeyEatsDB WHERE username = '".$username."';";

    $namecheck = mysqli_query($con, $namecheckquery) or die("2: name check query failed"); //error code #2 - name check query failed

    if (mysqli_num_rows($namecheck) > 0){
        echo "3: name alredy exists"; //error code #3 - name exists, cannot register
        exit();
    }

    //add user to the table

    $salt = "\$5\$rounds=5000\$" . "potatoes" . $username . "\$";
    $hash = crypt($password, $salt);
    $insertuserquery = "INSERT INTO slimeyEatsDB (username, hash, salt) VALUES ('" . $username . "','" . $hash . "','" . $salt . "');";
    mysqli_query($con,$insertuserquery) or die("4: Insert player query failed"); //error code #4 - insert query failed

    echo("0"); // no error

?>