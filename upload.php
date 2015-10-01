<?php 

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$servername = "localhost";
$username = "root";
$password = "piedpiper";
$dbname = "questions";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO quest (question_no, subgroup, question, answer, file)
VALUES ('$_POST[question_no]','$_POST[subgroup]', '$_POST[question]', '$_POST[answer]', '$target_file')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. Ended here!";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


?>