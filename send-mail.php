<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = !empty($_POST['subject']) ? htmlspecialchars($_POST['subject']) : "New Contact Form Submission";
    $message = htmlspecialchars($_POST['message']);

    $to = "info@jdntca.com"; // your domain email
    $mail_subject = "Contact Form: " . $subject;

    $body  = "You have received a new message from your website contact form:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n";
    $body .= "Message:\n$message\n";

     $headers  = "From: info@jdntca.com\r\n"; // must be your domain email
$headers .= "Reply-To: $email\r\n";      // so you can reply to sender
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $mail_subject, $body, $headers)) {
        header("Location: contact.html?success=1");
    } else {
        $error = "❌ Sorry, something went wrong. Please try again.";
    }
}
?>