<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Book Catalog</h2>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBookModal">Add Book</button>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>ISBN</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Year Published</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="bookTable">
            <?php
            $query = "SELECT * FROM books";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['isbn']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['publisher']}</td>
                    <td>{$row['year_published']}</td>
                    <td>{$row['category']}</td>
                    <td>
                        <button class='btn btn-warning btn-sm edit-btn' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#editBookModal'>Edit</button>
                        <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}'>Delete</button>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addBookForm">
                        <input type="text" class="form-control mb-2" id="title" placeholder="Title" required>
                        <input type="text" class="form-control mb-2" id="isbn" placeholder="ISBN" required>
                        <input type="text" class="form-control mb-2" id="author" placeholder="Author" required>
                        <input type="text" class="form-control mb-2" id="publisher" placeholder="Publisher" required>
                        <input type="number" class="form-control mb-2" id="year" placeholder="Year Published" required>
                        <input type="text" class="form-control mb-2" id="category" placeholder="Category" required>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editBookForm">
                        <input type="hidden" id="edit-id">
                        <input type="text" class="form-control mb-2" id="edit-title" required>
                        <input type="text" class="form-control mb-2" id="edit-isbn" required>
                        <input type="text" class="form-control mb-2" id="edit-author" required>
                        <input type="text" class="form-control mb-2" id="edit-publisher" required>
                        <input type="number" class="form-control mb-2" id="edit-year" required>
                        <input type="text" class="form-control mb-2" id="edit-category" required>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>

</body>
</html>
