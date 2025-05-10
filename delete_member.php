<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: homepage.php");
    exit;
}

$xmlFile = 'members.xml';

// Load XML file
if (!file_exists($xmlFile)) {
    die("Error: XML file not found.");
}

libxml_use_internal_errors(true);
$xml = simplexml_load_file($xmlFile);
if ($xml === false) {
    echo "Failed loading XML:\n";
    foreach(libxml_get_errors() as $error) {
        echo $error->message . "<br>";
    }
    exit;
}

// Convert SimpleXML to DOMDocument for safe node removal
$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->load($xmlFile);

// Use XPath to find the member node with matching id
$xpath = new DOMXPath($dom);
$nodes = $xpath->query("/members/member[id='$id']");

if ($nodes->length === 0) {
    // No member found with this ID
    header("Location: homepage.php");
    exit;
}

// Remove the member node
foreach ($nodes as $node) {
    $node->parentNode->removeChild($node);
}

// Save the updated XML
if ($dom->save($xmlFile) === false) {
    die("Error saving XML file.");
}

header("Location: homepage.php");
exit;
