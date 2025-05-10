<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlFile = 'members.xml';
    $xml = simplexml_load_file($xmlFile);

    // Generate new ID (optional, if you use IDs)
    $lastMember = $xml->member[count($xml->member) - 1] ?? null;
    $newId = $lastMember ? ((int)$lastMember->id + 1) : 1;

    $member = $xml->addChild('member');
    $member->addChild('id', $newId);
    $member->addChild('fullname', $_POST['fullname']);
    $member->addChild('studentid', $_POST['studentid']);
    $member->addChild('course', $_POST['course']);
    $member->addChild('yearlevel', $_POST['yearlevel']);  // Added year level here

    $xml->asXML($xmlFile);

    header("Location: homepage.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Member</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>MENU</h2>
        <ul>
            <li><a href="homepage.php">Registered Members</a></li>
            <li class="active"><a href="add_member.php">Add Member</a></li>
            <li><a href="announcement.php">Announcement</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="topbar">
        ADD NEW MEMBER
    </div>
    <div class="main-content">
        <form class="add-member-form" method="post" action="add_member.php">
            <h3>Add New Member</h3>
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="text" name="studentid" placeholder="Student ID" required>
            <input type="text" name="course" placeholder="Course" required>
            <input type="number" name="yearlevel" placeholder="Year Level" min="1" max="10" required> <!-- Added Year Level input -->
            <input type="submit" value="Add Member">
        </form>
        <br>
        <a href="homepage.php" class="action-btn" style="background:#800000; padding:10px 15px; color:#fff; border-radius:4px; text-decoration:none;">Back to Members List</a>
    </div>
</body>
</html>
