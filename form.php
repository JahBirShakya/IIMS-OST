<?php

    $FName = $_POST['FName'];
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $mail = $_POST['mail'];
    $passwd = $_POST['passwd'];
if(!empty($Fname) || !empty($username) || !empty($mobile) || !empty($address) || !empty($gender) || !empty($mail) || !empty($passwd)) {
    //Create Connection	
    $conn = new mysqli('localhost','phpadmin','passw0rd@MYSQL','dbase');
    if(mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT username From register Where username = ? Limit 1";
        $Query = "INSERT INTO register (FName, username, mobile, address, gender, mail, passwd) values (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($Query);
            $stmt->bind_param("ssissss",$FName, $username, $mobile, $address, $gender, $mail, $passwd);
            $stmt->execute();
            echo "New record inserted Sucessfully";
        }
        else{
            echo "Try using different username";
        }
    $stmt->close();
    $conn->close();
    }
}
else{
    echo "All fields are required";
}   
?>
