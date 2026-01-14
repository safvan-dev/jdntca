<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname   = htmlspecialchars($_POST['fullname']);
    $age        = htmlspecialchars($_POST['age']);
    $email      = htmlspecialchars($_POST['email']);
    $phone      = htmlspecialchars($_POST['phone']);
    $city       = htmlspecialchars($_POST['city']);
    $state      = htmlspecialchars($_POST['state']);
    $position   = htmlspecialchars($_POST['position']);
    $about      = htmlspecialchars($_POST['about']);

    // File upload handling
    $resume = $_FILES['resume'];
    $uploadDir = "uploads/";  
    $uploadFile = $uploadDir . basename($resume["name"]);
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedTypes = ['pdf', 'doc', 'docx'];

    // Check for upload errors
    if ($resume['error'] !== UPLOAD_ERR_OK) {
        die("❌ File upload error. Code: " . $resume['error']);
    }

    if (!in_array($fileType, $allowedTypes)) {
        die("❌ Only PDF, DOC, or DOCX files are allowed.");
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // auto-create folder
    }

    if (move_uploaded_file($resume["tmp_name"], $uploadFile)) {
        // Mail details
        $to = "info@jdntca.com";
        $subject = "New Job Application from $fullname";
        
        $message = "
        <h2>New Job Application Received</h2>
        <p><strong>Name:</strong> $fullname</p>
        <p><strong>Age:</strong> $age</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>City:</strong> $city</p>
        <p><strong>State:</strong> $state</p>
        <p><strong>Position Applied:</strong> $position</p>
        <p><strong>About:</strong> $about</p>
        <p><strong>Resume File:</strong> <a href='$uploadFile'>Download</a></p>
        ";

        $headers  = "From: info@jdntca.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($to, $subject, $message, $headers)) {
            header("Location: career.html?success=1");
            exit;
        } else {
            echo "❌ Mail could not be sent. Check your mail server settings.";
        }
    } else {
        echo "❌ File upload failed. Could not move file to uploads/ folder.";
    }
    
}
?>
