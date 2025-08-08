<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
// Connect to database to show recent students on home page
$conn = new mysqli("localhost", "root", "", "student_db");
$recentStudents = $conn->query("SELECT * FROM students ORDER BY id DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Balighot,Turaya,Defeo Student Management</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="light-mode">
  <!-- Background Animation -->
  <div class="jdm-background">
    <div class="neon-lights"></div>
    <div class="city"></div>
    <div class="road"></div>
    <div class="car"></div>
    <div class="car"></div> <!-- Second car -->
  </div>

  <!-- Theme Toggle and Logout Button -->
  <div class="toggle-container">
    <div class="d-flex gap-2">
      <button id="modeToggle" class="btn btn-outline-jdm">🌙 Dark Mode</button>
      <a href="logout.php" class="btn btn-outline-jdm">🚪 Logout</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container text-center main-content">
    <h1 class="header-title animate__animated animate__fadeInDown">BALIGHOT,TURAYA,DEFEO STUDENT MANAGEMENT</h1>
    <p class="header-subtitle animate__animated animate__fadeIn animate__delay-1s">SKILLS FOR THE FUTURE</p>

    <div class="row justify-content-center g-4 mb-5">
      <div class="col-md-4 col-sm-6 animate__animated animate__fadeInLeft animate__delay-1s">
        <a href="add.php" class="btn btn-jdm w-100 py-3">
          <span class="d-block fs-4">➕</span>
          <span>ADD STUDENT</span>
        </a>
      </div>
      <div class="col-md-4 col-sm-6 animate__animated animate__fadeInRight animate__delay-1s">
        <a href="view.php" class="btn btn-jdm w-100 py-3">
          <span class="d-block fs-4">📋</span>
          <span>VIEW STUDENTS</span>
        </a>
      </div>
    </div>

    <!-- Recent Students Section Only -->
    <?php if ($recentStudents->num_rows > 0): ?>
    <div class="recent-students mt-5 animate__animated animate__fadeInUp animate__delay-2s">
      <h2 class="section-title jdm-font">🌟 RECENTLY ADDED STUDENTS</h2>
      <div class="row justify-content-center">
        <?php while($student = $recentStudents->fetch_assoc()): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
          <div class="student-card p-4">
            <div class="student-avatar mb-3">
              <?= strtoupper(substr($student['name'], 0, 1)) ?>
            </div>
            <h5 class="student-name"><?= htmlspecialchars($student['name']) ?></h5>
            <p class="text-muted student-course"><?= htmlspecialchars($student['course']) ?></p>
            <div class="student-info">
              <small class="student-email"><?= htmlspecialchars($student['email']) ?></small><br>
              <small class="student-dob">DOB: <?= htmlspecialchars($student['dob']) ?></small>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <script src="script.js"></script>

  <!-- Credits Button -->
  <div class="credits-btn">
    <button id="creditsBtn" class="btn btn-link">© 2025 All Rights Reserved</button>
  </div>

  <style>
    /* Enhanced Student Card Styles */
    .student-card {
      background-color: var(--card-bg);
      border-radius: 15px;
      transition: all 0.3s ease;
      height: 100%;
      border: 1px solid rgba(0, 255, 255, 0.2);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .dark-mode .student-card {
      background-color: rgba(10, 10, 18, 0.7);
      border: 1px solid rgba(0, 255, 255, 0.3);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .student-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 255, 255, 0.2);
    }

    .dark-mode .student-card:hover {
      box-shadow: 0 10px 25px rgba(0, 255, 255, 0.4);
    }

    .student-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      font-weight: bold;
      margin: 0 auto 15px;
      background-color: rgba(255, 30, 86, 0.1);
      color: var(--neon-pink);
      border: 2px solid var(--neon-pink);
    }

    .dark-mode .student-avatar {
      background-color: rgba(0, 255, 255, 0.1);
      color: var(--neon-blue);
      border-color: var(--neon-blue);
    }

    .student-name {
      color: var(--neon-blue);
      margin-bottom: 5px;
      font-weight: bold;
    }

    .student-course {
      color: var(--text-secondary);
      font-size: 0.9rem;
    }

    .student-info small {
      display: block;
      color: var(--text-secondary);
      font-size: 0.85rem;
    }
  </style>
</body>
</html>