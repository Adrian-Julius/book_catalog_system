document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("addBookForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let formData = new FormData();
      formData.append("action", "add");
      formData.append("title", document.getElementById("title").value);
      formData.append("isbn", document.getElementById("isbn").value);
      formData.append("author", document.getElementById("author").value);
      formData.append("publisher", document.getElementById("publisher").value);
      formData.append("year", document.getElementById("year").value);
      formData.append("category", document.getElementById("category").value);

      fetch("crud.php", {
        method: "POST",
        body: formData,
      }).then(() => location.reload());
    });

  document.body.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("edit-btn")) {
      const bookId = e.target.dataset.id;
      fetch(`crud.php?id=${bookId}`)
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then((book) => {
          if (book && book.id) {
            document.getElementById("edit-id").value = book.id;
            document.getElementById("edit-title").value = book.title;
            document.getElementById("edit-isbn").value = book.isbn;
            document.getElementById("edit-author").value = book.author;
            document.getElementById("edit-publisher").value = book.publisher;
            document.getElementById("edit-year").value = book.year_published;
            document.getElementById("edit-category").value = book.category;
          } else {
            console.error("No book found for editing.");
          }
        })
        .catch((error) => {
          console.error("Error fetching book data:", error);
        });
    }
  });

  document
    .getElementById("editBookForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let formData = new FormData();
      formData.append("action", "edit");
      formData.append("id", document.getElementById("edit-id").value);
      formData.append("title", document.getElementById("edit-title").value);
      formData.append("isbn", document.getElementById("edit-isbn").value);
      formData.append("author", document.getElementById("edit-author").value);
      formData.append(
        "publisher",
        document.getElementById("edit-publisher").value
      );
      formData.append("year", document.getElementById("edit-year").value);
      formData.append(
        "category",
        document.getElementById("edit-category").value
      );

      fetch("crud.php", {
        method: "POST",
        body: formData,
      }).then(() => {
        location.reload();
      });
    });

  document.body.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("delete-btn")) {
      let id = e.target.dataset.id;
      if (confirm("Are you sure you want to delete this book?")) {
        fetch("crud.php", {
          method: "POST",
          body: new URLSearchParams({ action: "delete", id: id }),
        }).then(() => location.reload());
      }
    }
  });
});
