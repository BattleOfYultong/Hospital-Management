<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../php/config.php';

    $name = $connections->real_escape_string($_POST['name']);
    $concerns = $connections->real_escape_string($_POST['concerns']);

    $sql = "INSERT INTO request_tbl (requesterName, Concern) VALUES (?, ?)";
    $stmt = $connections->prepare($sql);
    $stmt->bind_param("ss", $name, $concerns);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
        echo "<script>window.location.href='patient.php?request_success=true';</script>";
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $connections->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
