<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Email recipient
    $to = "info@edufordindustries.com";  // Change this to your actual email address
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Email subject
    $email_subject = "Contact Form Submission: $subject";
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message:\n$message\n";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message.";
    }
} else {
    echo "Invalid request.";
}
?>
