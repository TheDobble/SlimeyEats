<?php
    $con = mysqli_connect("slimeyeats-do-user-8896225-0.b.db.ondigitalocean.com", "doadmin", "c03hefu7f7l8ote3", "slimeyEats",25060);

    //check that connect hapen

    if(mysqli_connect_errno()){
        echo "1: connection failed"; //error code #1 = connection failed
        exit();
    }

    $username = mysqli_real_escape_string($con,$_POST["name"]);
    $usernameClean = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

    if($username != $usernameClean){
        echo "8: funky username"; //error code #8 = username is not normal
        exit();
    }
    $password = $_POST["password"];

    //check if name taken

    $namecheckquery = "SELECT username, salt, hash, inventory FROM slimeyEatsDB WHERE username = '".$username."';";

    $namecheck = mysqli_query($con, $namecheckquery) or die("2: name check query failed"); //error code #2 - name check query failed

    if (mysqli_num_rows($namecheck) != 1){
        echo "5: Either no user with name or more than one"; //error code #5 - Either no user with name or more than one
        exit();
    }

    //get login info from query

    $existinginfo = mysqli_fetch_assoc($namecheck);
    $salt = $existinginfo["salt"];
    $hash = $existinginfo["hash"];

    $loginHash = crypt($password, $salt);

    if($hash != $loginHash){
        echo "6: Incorrect password"; // Error code #6 - password doesnt match
        exit();
    }

    echo "0 \t ". $existinginfo["inventory"];
?>