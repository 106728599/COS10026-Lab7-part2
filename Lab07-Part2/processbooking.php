<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
</head>

<body>
    <header>
        <h1>Rohirrim Tour Booking Confirmation</h1>
    </header>

<?php
    function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    if (isset($_POST["firstname"])) {
        $err_msg="";
        $first_name = $_POST["firstname"];
        $last_name = $_POST["lastname"];
        $age = $_POST["age"];

        // first name
        if (trim($first_name)=="") {
            $err_msg .= "<p>Please enter first name. </p>";
        }
        else {
            $first_name=sanitise_input($first_name);
            if (!preg_match("/^[a-zA-Z]{2,40}$/",$first_name)){
                $err_msg .= "<p>Only letters are allowed in first name.</p>";
            }
        }

        // last name
        if (trim($last_name)=="") {
            $err_msg .= "<p>Please enter last name. </p>";
        }
        else {
            $last_name=sanitise_input($last_name);
            if (!preg_match("/^[a-zA-Z]{2,40}$/",$last_name)){
                $err_msg .= "<p>Only letters are allowed in last name.</p>";
            }
        }

        // age
        if (trim($age)=="") {
            $err_msg .= "<p>Please enter age.</p>";
        }
        else {
            $age = sanitise_input($age);
            if (!preg_match("/^[0-9]+$/", $age)) {
                $err_msg .= "<p>Age is not valid.</p>";
            }
            elseif ($age < 0 || $age > 120) {
                $err_msg .= "<p>Age is not valid.</p>";
            }
        }

        // species
        if (!isset($_POST["species"])) {
            $err_msg .= "<p>Please select your species.</p>";
        }
        else {
            $species = sanitise_input($_POST["species"]);
        }

        // trip 
        $trip = "";
        if (isset($_POST["accom"])) {
            $trip .= "One-day tour";
        }
        if (isset($_POST["4day"])) {
            $trip .= "Four-day tour";
        }
        if (isset($_POST["10day"])) {
            $trip .= "Ten-day tour";
        }
        if ($trip = "") {
            $err_msg .= "<p>Please select at least one trip.</p>";
        }
        
        // menu
        $food = sanitise_input($_POST["food"]);

        // travellers
        $partysize = $_POST["partysize"];

        if (trim($partysize)=="") {
            $err_msg .= "<p>Please enter the number of travellers.</p>";
        }
        else {
            $partysize = sanitise_input($partysize);
            if (!preg_match("/^[0-9]+$/", $partysize) || $partysize < 1) {
                $err_msg .= "<p>Number of travellers is not valid.</p>";
            }
        }


        // display error msg or welcome info
        if ($err_msg!="") {
            echo $err_msg;
        }
        else {
            echo "<p>Welcome $first_name $last_name !</p>";
            echo "<p>You are now booked on the $trip</p>";

            echo "<p>Species: ";
            if ($species == "M") {
                echo "Human";
            }
            elseif ($species == "D") {
                echo "Dwarf";
            }
            elseif ($species == "E") {
                echo "Elf";
            }
            elseif ($species == "H") {
                echo "Hobbit";
            }
            echo "</p>";

            echo "<p>Age: $age</p>";
            echo "<p>Meal Preference: $food</p>";
            echo "<p>Number of travellers: $partysize</p>";
        }
    }
else {
    header ("location:register.html"); // redirect to the form
    exit();
}

?>
</body>
</html>