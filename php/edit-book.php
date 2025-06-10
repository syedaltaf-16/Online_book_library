<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    header("Location: ../login.php");
    exit;
}

include "../db_conn.php";

function upload_file($file, $allowed_exts, $upload_folder) {
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $response = ['status' => '', 'data' => ''];

    if (!in_array($file_ext, $allowed_exts)) {
        $response['status'] = 'error';
        $response['data'] = "File type .$file_ext not allowed.";
        return $response;
    }

    $new_name = uniqid() . "." . $file_ext;
    $destination = "../uploads/$upload_folder/$new_name";

    if (move_uploaded_file($file_tmp, $destination)) {
        $response['status'] = 'success';
        $response['data'] = $new_name;
    } else {
        $response['status'] = 'error';
        $response['data'] = "Failed to upload file.";
    }

    return $response;
}

if (
    isset($_POST['book_id']) &&
    isset($_POST['book_title']) &&
    isset($_POST['book_description']) &&
    isset($_POST['book_author']) &&
    isset($_POST['book_category']) &&
    isset($_POST['current_cover']) &&
    isset($_POST['current_file'])
) {
    $id = $_POST['book_id'];
    $title = trim($_POST['book_title']);
    $description = trim($_POST['book_description']);
    $author = $_POST['book_author'];
    $category = $_POST['book_category'];
    $current_cover = $_POST['current_cover'];
    $current_file = $_POST['current_file'];

    if (empty($title) || empty($description) || empty($author) || empty($category)) {
        $error = "Please fill in all required fields.";
        header("Location: ../edit-book.php?id=$id&error=" . urlencode($error));
        exit;
    }

    // Start with current files
    $new_cover = $current_cover;
    $new_file = $current_file;

    // Upload new cover file if any
    if (isset($_FILES['book_cover']) && !empty($_FILES['book_cover']['name'])) {
        $allowed_images = ['jpg', 'jpeg', 'png'];
        $upload_result = upload_file($_FILES['book_cover'], $allowed_images, 'cover');

        if ($upload_result['status'] == 'error') {
            header("Location: ../edit-book.php?id=$id&error=" . urlencode($upload_result['data']));
            exit;
        }

        // Delete old cover file if exists
        if ($current_cover && file_exists("../uploads/cover/$current_cover")) {
            unlink("../uploads/cover/$current_cover");
        }

        $new_cover = $upload_result['data'];
    }

    // Upload new book file if any
    if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
        $allowed_files = ['pdf', 'docx', 'pptx'];
        $upload_result = upload_file($_FILES['file'], $allowed_files, 'files');

        if ($upload_result['status'] == 'error') {
            header("Location: ../edit-book.php?id=$id&error=" . urlencode($upload_result['data']));
            exit;
        }

        // Delete old book file if exists
        if ($current_file && file_exists("../uploads/files/$current_file")) {
            unlink("../uploads/files/$current_file");
        }

        $new_file = $upload_result['data'];
    }

    // Update the database record
    $sql = "UPDATE books SET title = ?, description = ?, author_id = ?, category_id = ?, cover = ?, file = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$title, $description, $author, $category, $new_cover, $new_file, $id]);

    if ($res) {
        $success = "Book updated successfully!";
        header("Location: ../edit-book.php?id=$id&success=" . urlencode($success));
        exit;
    } else {
        $error = "Failed to update the book.";
        header("Location: ../edit-book.php?id=$id&error=" . urlencode($error));
        exit;
    }
} else {
    header("Location: ../admin.php");
    exit;
}
