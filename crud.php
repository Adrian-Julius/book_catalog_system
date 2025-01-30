<?php
include 'connect.php';

if ($_POST['action'] == 'add') {
    $stmt = $conn->prepare("INSERT INTO books (title, isbn, author, publisher, year_published, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $_POST['title'], $_POST['isbn'], $_POST['author'], $_POST['publisher'], $_POST['year'], $_POST['category']);
    $stmt->execute();
    echo json_encode(["success" => true]);
    exit();
}

if ($_POST['action'] == 'delete') {
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    echo json_encode(["success" => true]);
    exit();
}

if ($_POST['action'] == 'edit') {
    $stmt = $conn->prepare("UPDATE books SET title = ?, isbn = ?, author = ?, publisher = ?, year_published = ?, category = ? WHERE id = ?");
    $stmt->bind_param("ssssdsi", $_POST['title'], $_POST['isbn'], $_POST['author'], $_POST['publisher'], $_POST['year'], $_POST['category'], $_POST['id']);
    $stmt->execute();
    echo json_encode(["success" => true]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        echo json_encode($book); // Return book data as JSON
    } else {
        echo json_encode(["error" => "Book not found"]);
    }
}
?>
