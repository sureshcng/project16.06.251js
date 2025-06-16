<?php
include('db.php');
header('Content-Type: application/json');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for required fields
    if (isset($_POST['name'])  && isset($_POST['password'])) {
        $name = $_POST['name'];
        
        $password = $_POST['password'];

        // Insert data into the database
        $sql = "INSERT INTO api_reg1 (name, password) VALUES ('$name','$password')";
        if ($conn->query($sql)) {
            // Fetch the newly inserted record
            $last_id = $conn->insert_id;
            $result = $conn->query("SELECT id, name,password FROM api_reg1 WHERE id = $last_id");

            if ($result && $row = $result->fetch_assoc()) {
            //    $_SESSION['id']= $row['id'];

                echo json_encode(["message" => "Record added successfully.", "data" => $row]);
            } else {
                echo json_encode(["message" => "Error fetching inserted data."]);
            }
        } else {
            echo json_encode(["message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["message" => "Invalid input or missing required fields."]);
    }
}


?>
