<?php
$newAdminPassword = 'suram';  // Replace with the desired password
$hashedPassword = password_hash($newAdminPassword, PASSWORD_DEFAULT);

echo "Hashed Password: " . $hashedPassword;
?>