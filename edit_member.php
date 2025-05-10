<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

// Load XML and find member by id
$xmlFile = 'members.xml';
$xml = simplexml_load_file($xmlFile);

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: homepage.php");
    exit;
}

$memberToEdit = null;
foreach ($xml->member as $member) {
    if ((string)$member->id === $id) {
        $memberToEdit = $member;
        break;
    }
}

if (!$memberToEdit) {
    header("Location: homepage.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Member</title>
    <link rel="stylesheet" href="edit-member.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="homepage.php">Registered Members</a></li>
            <li class="active"><a href="edit_member.php?id=<?php echo htmlspecialchars($id); ?>">Edit Member</a></li>
            <li><a href="add_member.php">Add Member</a></li>
            <li><a href="announcement.php">Announcement</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="topbar">
        EDIT MEMBER
    </div>

    <div class="main-content">
        <div class="form-wrapper">
            <form method="post" action="update_member.php">
                <h2>Edit Member</h2>

                <div class="input-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($memberToEdit->fullname); ?>" required>
                </div>

                <div class="input-group">
                    <label for="studentid">Student ID</label>
                    <input type="text" id="studentid" name="studentid" value="<?php echo htmlspecialchars($memberToEdit->studentid); ?>" required>
                </div>

                <div class="input-group">
                    <label for="course">Course</label>
                    <input type="text" id="course" name="course" value="<?php echo htmlspecialchars($memberToEdit->course); ?>" required>
                </div>

                <div class="input-group">
                    <label for="yearlevel">Year Level</label>
                    <input type="number" id="yearlevel" name="yearlevel" value="<?php echo htmlspecialchars($memberToEdit->yearlevel); ?>" min="1" max="10" required>
                </div>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($memberToEdit->id); ?>">

                <input type="submit" value="Update Member">
            </form>

            <a href="homepage.php" class="back-link">&larr; Back to Members List</a>
        </div>
    </div>
</body>
</html>
