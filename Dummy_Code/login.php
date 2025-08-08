<?php
session_start();

$conn = new mysqli("localhost", "root", "", "student_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Existing login logic
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        
        $result = $conn->query("SELECT * FROM students WHERE name = '$name' AND email = '$email'");
        
        if ($result->num_rows > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $name;
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid credentials or account doesn't exist";
        }
    } elseif (isset($_POST['create_account'])) {
        // New account creation logic
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $course = $conn->real_escape_string($_POST["course"]);
        $dob = $conn->real_escape_string($_POST["dob"]);
        
        // Check if email exists
        $check = $conn->query("SELECT id FROM students WHERE email = '$email'");
        if ($check->num_rows > 0) {
            $error = "This email is already registered";
        } else {
            // Insert new student
            $conn->query("INSERT INTO students (name, email, course, dob) VALUES ('$name', '$email', '$course', '$dob')");
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $name;
            header("Location: index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login | Balighot,Turaya,Defeo System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="light-mode">
  <div class="jdm-background">
    <div class="neon-lights"></div>
    <div class="city"></div>
    <div class="road"></div>
    <div class="car"></div>
    <div class="car"></div>
  </div>

  <!-- Theme Toggle -->
  <div class="toggle-container">
    <button id="modeToggle" class="btn btn-outline-jdm">🌙 Dark Mode</button>
  </div>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4 animate__animated animate__fadeIn">
        <div class="login-card p-4">
          <div class="login-header text-center mb-4">
            <h2 class="jdm-font">🔒 LOGIN</h2>
            <p class="text-muted">Enter your credentials to access the system</p>
          </div>
          
          <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show">
              <?= $error ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
          
          <form method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="d-grid">
              <button type="submit" name="login" class="btn btn-jdm btn-lg">
                <span class="d-flex align-items-center justify-content-center">
                  <span class="me-2">LOGIN</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                  </svg>
                </span>
              </button>
            </div>
          </form>
          
          <div class="text-center mt-3">
            <button class="btn btn-link text-jdm" data-bs-toggle="modal" data-bs-target="#createAccountModal">
              Don't have an account? Create one
            </button>
          </div>
          
          <div class="login-footer mt-4 text-center">
            <p class="text-muted small">Balighot, Turaya, Defeo Student Management System</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Create Account Modal -->
  <div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="createAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title jdm-font" id="createAccountModalLabel">➕ CREATE ACCOUNT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" id="createAccountForm">
            <div class="mb-3">
              <label class="form-label">FULL NAME</label>
              <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">EMAIL ADDRESS</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">SELECT COURSE</label>
              <select name="course" class="form-select" required>
                <option value="" disabled selected>SELECT COURSE</option>
                <option value="" disabled>―――― COMPUTING ――――</option>
                <option value="BSIT">BS in Information Technology</option>
                <option value="BSCS">BS in Computer Science</option>
                <option value="BSCE">BS in Computer Engineering</option>
                <option value="BSIS">BS in Information System</option>
                <option value="BSCY">BS in Cybersecurity</option>
                <option value="BSDS">BS in Data Science</option>
                <option value="BSBT">BS in Blockchain Technology</option>
                <option value="BSAI">BS in Artificial Intelligence</option>
                <option value="BSEMC">BS in Entertainment & Multimedia Computing</option>
                <option value="" disabled>―― BUSINESS & MANAGEMENT ――</option>
                <option value="BSBA-MM">BSBA in Marketing Management</option>
                <option value="BSBA-HRM">BSBA in Human Resource Management</option>
                <option value="BSBA-MIS">BSBA in Management Info System</option>
                <option value="BSBA-FM">BSBA in Financial Management</option>
                <option value="BSE">BS in Entrepreneurship</option>
                <option value="BSREM">BS in Real Estate Management</option>
                <option value="" disabled>――― INDUSTRY SKILLS ―――</option>
                <option value="AMASS">AMASS Industry Certification</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label">DATE OF BIRTH</label>
              <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="d-grid">
              <button type="submit" name="create_account" class="btn btn-jdm btn-lg">CREATE ACCOUNT</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>

  <!-- Credits Button -->
  <div class="credits-btn">
    <button id="creditsBtn" class="btn btn-link">© 2025 All Rights Reserved</button>
  </div>
</body>
</html>