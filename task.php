<?php
  // Validate inputs
  if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
    echo "All fields are required.";
    exit;
  }

  // Check if email/username already exists
  $query = "SELECT * FROM users WHERE email = '".$_POST['email']."' OR username = '".$_POST['username']."'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    echo "Username or Email already exists.";
    exit;
  }

  // Hash password
  $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Insert user data into the database
  $query = "INSERT INTO users (username, email, password) VALUES ('".$_POST['username']."', '".$_POST['email']."', '".$hashed_password."')";
  mysqli_query($conn, $query);

  // Show success message
  echo "Signup successful.";
?>
