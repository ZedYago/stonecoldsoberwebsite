<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate form data
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Create the email content
        $to = "your-email@example.com";  // Replace with your email address
        $subject = "New Contact Form Submission from $name";
        $body = "You have received a new message from the contact form.\n\n".
                "Name: $name\n".
                "Email: $email\n".
                "Message: $message\n";
        $headers = "From: $email";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            // Success message
            echo "Thank you! Your message has been sent.";
        } else {
            // Failure message
            echo "Oops! Something went wrong, and we couldn't send your message.";
        }
    } else {
        // Invalid form data
        echo "Please complete the form and provide a valid email address.";
    }
}
?>
