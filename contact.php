<?php
// Replace with your email address for receiving contact form submissions
$recipient_email = "jfroyalelogistics@gmail.com"; 

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Initialize variables and errors array
  $name = "";
  $email = "";
  $subject = "";
  $message = "";
  $errors = [];

  // Validate name
  if (empty($_POST['name'])) {
    $errors[] = "Please enter your name.";
  } else {
    $name = trim($_POST['name']);
  }

  // Validate email
  if (empty($_POST['email'])) {
    $errors[] = "Please enter your email address.";
  } else {
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format.";
    }
  }

  // Validate subject
  if (empty($_POST['subject'])) {
    $errors[] = "Please enter a subject.";
  } else {
    $subject = trim($_POST['subject']);
  }

  // Validate message
  if (empty($_POST['message'])) {
    $errors[] = "Please enter your message.";
  } else {
    $message = trim($_POST['message']);
  }

  // If no errors, send email
  if (empty($errors)) {
    // Prepare email content
    $email_subject = "Contact Form Submission: $subject";
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Message: \n$message";

    // Set email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email using mail function
    if (mail($recipient_email, $email_subject, $body, $headers)) {
      echo "<div class='alert alert-success'>Your message has been sent. Thank you!</div>";
    } else {
      echo "<div class='alert alert-danger'>An error occurred while sending your message. Please try again later.</div>";
    }
  } else {
    echo "<div class='alert alert-danger'>" . implode('<br>', $errors) . "</div>";
  }
}
?>
