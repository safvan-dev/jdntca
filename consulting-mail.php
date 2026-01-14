<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize form inputs
    $name         = htmlspecialchars($_POST['name']);
    $designation  = htmlspecialchars($_POST['designation']);
    $organization = htmlspecialchars($_POST['organization']);
    $address      = htmlspecialchars($_POST['address']);
    $city         = htmlspecialchars($_POST['city']);
    $email        = htmlspecialchars($_POST['email']);
    $telephone    = htmlspecialchars($_POST['telephone']);
    $mobile       = htmlspecialchars($_POST['mobile']);
    $updates      = isset($_POST['updates']) ? htmlspecialchars($_POST['updates']) : "Not specified";
    $subject      = htmlspecialchars($_POST['subject']);
    $query        = htmlspecialchars($_POST['query']);

    // Change this to your real email
    $to = "info@jdntca.com";  

    $mail_subject = "Website Query: " . $subject;

    // Email Body
    $body  = "You have received a new query from your website:\n\n";
    $body .= "Name: $name\n";
    $body .= "Designation: $designation\n";
    $body .= "Organization: $organization\n";
    $body .= "Office Address: $address\n";
    $body .= "City: $city\n";
    $body .= "Email: $email\n";
    $body .= "Telephone: $telephone\n";
    $body .= "Mobile: $mobile\n";
    $body .= "Other Professional Updates: $updates\n";
    $body .= "Subject: $subject\n\n";
    $body .= "Query:\n$query\n";

    // Headers (use a valid domain email here for cPanel)
    //  $headers  = "From: $email\r\n";
    // $headers .= "Reply-To: info@jdntca.comn";

    $headers  = "From: info@jdntca.com\r\n"; // must be your domain email
$headers .= "Reply-To: $email\r\n";      // so you can reply to sender
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $mail_subject, $body, $headers)) {
        header("Location: counsulting.html?success=1");
    } else {
        $error = "❌ Sorry, something went wrong. Please try again.";
    }
}
?>

<!-- Show messages on same page -->

