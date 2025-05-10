<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlFile = 'members.xml';
    $xml = simplexml_load_file($xmlFile);

    $id = $_POST['id'] ?? null;
    if (!$id) {
        header("Location: homepage.php");
        exit;
    }

    foreach ($xml->member as $member) {
        if ((string)$member->id === $id) {
            $member->fullname = $_POST['fullname'];
            $member->studentid = $_POST['studentid'];
            $member->course = $_POST['course'];
            $member->yearlevel = $_POST['yearlevel'];
            break;
        }
    }

    $xml->asXML($xmlFile);
    header("Location: homepage.php");
    exit;
}
?>
