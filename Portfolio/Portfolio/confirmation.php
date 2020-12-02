<?php

/**
 *  confirmation.php
 *  Sarah Mehri
 *  12/1/202
 */
// Turn on error reporting

ini_set('display_errors', 1);

error_reporting(E_ALL);
//redirect if the form has not been submited
if(empty($_POST)){
    header("location: guestbook.php");
}
date_default_timezone_set( 'America/Los_Angeles');
include ('head.html');
require ('dbcreds.php');
require ('guestFunction.php');
?>

<body>



<div class="container" id="bg">


    <!-- Jumbotron header -->

    <div class="jumbotron">

        <h3>Thank you my friend, I will reach you soon!</h3>
        <h5> <a href="page1.php"> Admin page<i class="material-icons">favorite</i></a> </h5>
        <h5> <a href="guestbook.php"> Guestbook page <i class="material-icons">computer</i></a> </h5>


    </div>


    <?php
    $isValid = true;

    //check first name
    if(validName($_POST['fname'])){
        $fname = $_POST['fname'];
    }
    else{
        echo"<p> Invalid first name</p>";
        $isValid = false;
    }
    if(validName($_POST['lname'])){
        $lname = $_POST['lname'];

    }
    else{
        echo"<p> Invalid last name</p>";
        $isValid = false;
    }
    //check email
    $checkbox ="";
    if(isset($_POST['checkbox']) && checkbox($_POST['checkbox'])){
        $checkbox = $_POST['checkbox'];
        if((!validEmail($_POST['email']))) {
            echo"<p> please enter an email address</p>";
            $isValid = false;
        }
    }
    if (!empty($_POST['email']) && validEmail($_POST['email']) ) {

        $email = $_POST['email'];
    } else if (!empty($_POST['email']) && !validEmail($_POST['email']) ){
        echo "<p> Invalid email address</p>";
        $isValid = false;
    }

    if(($_POST['linkedin'])){
        if(validLinkIn($_POST['linkedin'])){
        $linkedin = $_POST['linkedin'];
    }
    else{
        echo"<p> Invalid linkedin</p>";
        $isValid = false;
    }
}
    if(isset($_POST['meet']) && validMeet($_POST['meet'])) {
        $meet = $_POST['meet'];
        }
        else{
            echo 'Please select how we meet.';
            $isValid = false;
        }
        $other = $_POST['otherInfo'];

    if(validOther($_POST['meet'])){

        if(validName($other)){
            $other = $_POST['otherInfo'];
    }
        else{
            echo'please specify how we meet';
            $isValid = false;
        }
}

//$checkbox= $_POST['checkbox'];

if(!$isValid) {
    return;
}
    //Get data from POST array
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $job = $_POST['jtitle'];
    $email = $_POST['email'];
    $linkedin = $_POST['linkedin'];

    $otherInfo = $_POST['otherInfo'];
$meet = $_POST['meet'];



   // $meet= $meet.$otherInfo;


$sql = "INSERT INTO guest(`fname`,`lname`,`email`,`job`,`meet`)
 VALUES('$fname', '$lname', '$email', '$job','$meet $otherInfo')";
$success = mysqli_query($cnxn, $sql);
if(!$success){
    echo "<p> sorry... something went wrong</p>";
    return;
}
    echo "<p>First Name:  $fname</p>";
    echo "<p>Last Name:  $lname</p>";
    echo "<p>Meeting:  $meet $otherInfo</p>";
   if($email){
       echo "<p>Email:  $email</p>";
   }
    if($linkedin){
        echo "<p>LinkedIn:  $linkedin</p>";
    }


?>




