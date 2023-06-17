<?php
// define variables to empty values
$nameErr = $emailErr = $mobilenoErr = $genderErr = $websiteErr = $agreeErr =
    "";
$name = $email = $mobileno = $gender = $website = $agree = "";
//Input fields validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //String Validation
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = input_data($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only alphabets and white space are allowed";
        }
    }
    //Email Validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = input_data($_POST["email"]);
        // check that the e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    //Number Validation
    if (empty($_POST["mobileno"])) {
        $mobilenoErr = "Mobile no is required";
    } else {
        $mobileno = input_data($_POST["mobileno"]);
        // check if mobile no is well-formed
        if (!preg_match("/^[0-9]*$/", $mobileno)) {
            $mobilenoErr = "Only numeric value is allowed.";
        }
        //check mobile no length should not be less and greator than 10
        if (strlen($mobileno) != 10) {
            $mobilenoErr = "Mobile no must contain 10 digits.";
        }
    }
    //URL Validation
    if (empty($_POST["website"])) {
        $website = "";
    } else {
        $website = input_data($_POST["website"]);
        // check if URL address syntax is valid
        if (
            !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-
    9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",
                $website
            )
        ) {
            $websiteErr = "Invalid URL";
        }
    }
    //Empty Field Validation
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = input_data($_POST["gender"]);
    }
    //Checkbox Validation
    if (!isset($_POST['agree'])) {
        $agreeErr = "Accept terms of services before submit.";
    } else {
        $agree = input_data($_POST["agree"]);
    }
}
function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['submit'])) {
    if (
        $nameErr == "" && $emailErr == "" && $mobilenoErr == "" && $genderErr ==
        "" && $websiteErr == "" && $agreeErr == ""
    ) {
        echo "<h3 color = #FF0001> <b>You have sucessfully registered.</b>
</h3>";
        echo "<h2>Your Input:</h2>";
        echo "Name: " . $name;
        echo "<br>";
        echo "Email: " . $email;
        echo "<br>";
        echo "Mobile No: " . $mobileno;
        echo "<br>";
        echo "Website: " . $website;
        echo "<br>";
        echo "Gender: " . $gender;
        echo "<h1>Thanks for your responce </h1>";
    } else {
        echo "<h3> <b>You didn't filled up the form correctly.</b> </h3>";
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'forms';
$connection = mysqli_connect($hostname, $username, $password, $database);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobileno'];
$website = $_POST['website'];
$gender = $_POST['gender'];
$name = mysqli_real_escape_string($connection, $name);
$query = "INSERT INTO forms_php (name, email,  mobile, website,
gender)
VALUES ('$name', '$email', '$mobileno', '$website', '$gender')";
$result = mysqli_query($connection, $query);
if ($result) {
    echo "Data successfully stored in the database.";
} else {
    echo "Error: " . mysqli_error($connection);
}
mysqli_close($connection);

?>