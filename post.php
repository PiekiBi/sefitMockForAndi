<?php
require_once "classes.php";

// Prüfen, ob der Content-Type auf application/json gesetzt ist
if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true); // Konvertiert JSON zu einem PHP-Array
    if ($data === null) {
        echo '{"status":"error", "message": "Fehler beim Lesen der JSON-Daten."}';
    } else {
        //Erstellung der FeedbackAspects-Objekte
        $aspects = [];
        if ($data['aspects'] != null) {
            foreach ($data['aspects'] as $aspect) {
                $aspects[] = new Aspect($aspect['name']);
            }
        }
        // Erstellung des GameFeedback-Objektes
        $exampleObject = new ExampleObject(
            $data['userName'],
            $data['description'],
            $aspects,
            $data['isRequest']
        );
        // Rückgabe einer Antwort
        $response = [
            'status' => 'success',
            'message' => 'Message received correctly.'
        ];

        http_response_code(200);
        echo json_encode($response);
    }
} else {
    http_response_code(500);

    // Rückgabe einer Antwort
    $response = [
        'status' => 'error',
        'message' => "Wrong Content-Type. Needed: application/json"
    ];
    echo json_encode($response);
}
