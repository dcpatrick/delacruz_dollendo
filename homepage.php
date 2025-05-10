<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

// Load members XML
$xmlFile = 'members.xml';
$xml = simplexml_load_file($xmlFile);

// Handle search
$search = $_GET['search'] ?? '';
$members = [];
foreach ($xml->member as $member) {
    if ($search === '' ||
        stripos($member->fullname, $search) !== false ||
        stripos($member->studentid, $search) !== false ||
        stripos($member->course, $search) !== false ||
        stripos($member->yearlevel, $search) !== false) {
        $members[] = $member;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registered Members</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>MENU</h2>
        <ul>
            <li class="active"><a href="homepage.php">Registered Members</a></li>
            <li><a href="add_member.php">Add Member</a></li>
             <li><a href="announcement.php">Announcement</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="topbar">
        REGISTERED MEMBER RECORDS
    </div>
    <div class="main-content">
        <div class="table-container">
            <form class="search-bar" method="get" action="homepage.php">
                <input type="text" name="search" placeholder="Search by name, ID, course, or year level" value="<?php echo htmlspecialchars($search); ?>">
                <input type="submit" value="Search">
                <a href="homepage.php" class="action-btn" style="background:#800000;">Clear</a>
            </form>
            <h3>Members List</h3>
            <table>
                <tr>
                    <th>Full Name</th>
                    <th>Student ID</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Actions</th>
                </tr>
                <?php if (count($members) === 0): ?>
                    <tr><td colspan="5">No members found.</td></tr>
                <?php else: ?>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($member->fullname); ?></td>
                            <td><?php echo htmlspecialchars($member->studentid); ?></td>
                            <td><?php echo htmlspecialchars($member->course); ?></td>
                            <td><?php echo htmlspecialchars($member->yearlevel); ?></td>
                            <td>
                                <a class="action-btn edit-btn" href="edit_member.php?id=<?php echo $member->id; ?>">Edit</a>
                                <a class="action-btn delete-btn" href="delete_member.php?id=<?php echo $member->id; ?>" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>
