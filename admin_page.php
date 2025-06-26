<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h1>Welcome, <span><?= htmlspecialchars($_SESSION['name']); ?></span></h1>
        <p>This is your <span>admin</span> dashboard</p>
        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>
    <script src="script.js"></script>
</body>
</html>