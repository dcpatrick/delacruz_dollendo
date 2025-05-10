<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>About - Member Management System</title>
    <link rel="stylesheet" href="about-style.css" />
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="homepage.php">Registered Members</a></li>
            <li><a href="add_member.php">Add Member</a></li>
            <li><a href="announcement.php">Announcement</a></li>
            <li class="active"><a href="about.php">About</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="topbar">
        ABOUT
    </div>

    <div class="page-wrapper">
        <div class="main-content">
            
            <p>
                Welcome to the Member Management System! This system allows you to register, edit, and manage members efficiently.
                It is designed with simplicity and usability in mind.
            </p>
            <p>
                Features include member registration, search, update, and deletion, all stored securely in XML files.
                The system ensures data integrity and easy maintenance.
            </p>

            <div class="admin-section">
                <div class="admin-card">
                    <img src="DELACRUZ.jpg" alt="Admin John Patrick Dela Cruz" class="admin-photo">
                    <div class="admin-label">ADMIN</div>
                    <div class="admin-name">John Patrick Dela Cruz</div>
                </div>
                <div class="admin-card">
                    <img src="DOLLENDO.jpg" alt="Admin Angelica Dollendo" class="admin-photo">
                    <div class="admin-label">ADMIN</div>
                    <div class="admin-name">Angelica Dollendo</div>
                </div>
            </div>

            <div class="info-box">
                Version: 1.0.0 &nbsp;&nbsp;|&nbsp;&nbsp; Developed by: D&D  &nbsp;&nbsp;|&nbsp;&nbsp; Contact: abcd@gmail.com
            </div>
        </div>
    </div>
</body>
</html>
