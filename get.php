<?php
require_once "classes.php";

$aspects = [
    new Aspect("test2"),
    new Aspect("test2")
];
$object = new ExampleObject("Bibi", "eine Beschreibung", $aspects, true);

header("Content-Type: application/json");

// Sendet die Daten als JSON zurück
http_response_code(200);
echo json_encode($object);
