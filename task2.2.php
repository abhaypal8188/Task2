<?php
  // Validate input fields
  if (empty($_POST['username_email']) || empty($_POST['password'])) {
    echo "All fields are required.";
    exit;
  }

  // Retrieve the hashed password from the database
  $query = "SELECT password FROM users WHERE email = '".$_POST['username_email']."' OR username = '".$_POST['username_email']."'";
  $result = mysqli_query($conn, $query);
  $hashed_password = mysqli_fetch_assoc($result)['password'];

  // Verify the password
  if (password_verify($_POST['password'], $hashed_password)) {
    // Start a session and redirect users to the dashboard
    session_start();
    $_SESSION['username'] = $_POST['username_email'];
    header("Location: dashboard.php");
    exit;
  } else {
    echo "Incorrect username/email or password.";
  }
?>
