<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filename = basename($_FILES['image']['name']);
        $targetPath = $uploadDir . uniqid() . '_' . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            echo json_encode(['success' => true, 'url' => $targetPath]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to move uploaded file.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No file uploaded or upload error.']);
    }
}
?>
