<?php

//if ($_SERVER['CONTENT_TYPE'] === 'video/mp4') {
    $filePath = 'amici.mp4'; // Pfad zur MP4-Datei

// Stelle sicher, dass die Datei existiert
    if (file_exists($filePath)) {
        // Setze den richtigen Content-Type
        header('Content-Type: video/mp4');

        // Empfohlen: Setze weitere Header, um den Download anzudeuten
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Accept-Ranges: bytes');

        // Öffne die Datei im Lesemodus
        $handle = fopen($filePath, 'rb');
        
        // Leere den Output Buffer, um sicherzustellen, dass keine zusätzlichen Daten gesendet werden
        ob_clean();
        flush();
        
        // Übertrage die Datei in Chunks
        while (!feof($handle)) {
            echo fread($handle, 8192); // Lese und sende in 8KB-Blöcken
            flush(); // Leere den Output Buffer
        }

        fclose($handle); // Schließe den Datei-Handle
        exit;
    } else {
        http_response_code(500);

        // Rückgabe einer Antwort
        $response = [
            'status' => 'error',
            'message' => "Can't find video...."
        ];
        echo json_encode($response);
    }
//} else {
//    http_response_code(500);
//
//    // Rückgabe einer Antwort
//    $response = [
//        'status' => 'error',
//        'message' => "Wrong Content-Type. Needed: video/mp4"
//    ];
//    echo json_encode($response);
//}
