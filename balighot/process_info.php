<?php
function sanitize($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

$name = sanitize($_POST['name'] ?? '');
$birthyear = sanitize($_POST['birthyear'] ?? '');
$sleephours = sanitize($_POST['sleephours'] ?? '');
$city = sanitize($_POST['city'] ?? '');

$errors = [];
if (!$name || !$birthyear || !$sleephours || !$city) {
  $errors[] = "All fields are required.";
}
if (!is_numeric($birthyear)) {
  $errors[] = "Birth year must be numeric.";
}

$currentYear = date("Y");
$age = $currentYear - (int)$birthyear;
$totalSleepYears = ($sleephours * 365 * $age) / 24;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chrome Hearts Results</title>
  <link href="https://fonts.googleapis.com/css2?family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
  <style>
    body {
      background: #0c0c0c;
      font-family: 'UnifrakturCook', cursive;
      color: #ccc;
      padding: 30px;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background-color: #111;
      padding: 30px;
      border: 3px solid silver;
      border-radius: 15px;
      box-shadow: 0 0 20px silver;
    }
    h1 {
      text-align: center;
      color: silver;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid silver;
      padding: 10px;
      text-align: center;
    }
    .message {
      margin-top: 20px;
      padding: 10px;
      border-top: 1px solid silver;
    }
  </style>
</head>
<body>
<div class="container">
  <h1>✠ Your Chrome Hearts Profile ✠</h1>
  <?php if ($errors): ?>
    <div class="message">
      <?php foreach ($errors as $error) echo "<p>⚠️ $error</p>"; ?>
    </div>
  <?php else: ?>
    <table>
      <tr><th>Full Name</th><td><?= $name ?></td></tr>
      <tr><th>Age</th><td><?= $age ?></td></tr>
      <tr><th>Total Years Sleeping</th><td><?= round($totalSleepYears, 2) ?></td></tr>
      <tr><th>City</th><td><?= $city ?></td></tr>
    </table>

    <div class="message">
      <?php
      if ($age > 50) echo "<p>🕯 You might want to start planning for retirement.</p>";
      if ($totalSleepYears > 15) echo "<p>💤 You’ve spent a huge part of your life sleeping!</p>";
      echo ($city !== \"Quezon City\") ? \"<p>🏙 You don’t live in the best city.</p>\" : \"<p>🎉 Quezon City rocks!</p>\";
      if ($age <= 25) echo \"<p>📚 You're still young, enjoy learning!</p>\";
      ?>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
