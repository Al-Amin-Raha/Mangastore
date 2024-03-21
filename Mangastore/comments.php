<?php
include 'dbConnect.php';
session_start();


// Function to fetch comments
function fetchComments($conn)
{
    $sql = "SELECT Manga_ID, Email, Comment FROM browse";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to delete a comment
function deleteComment($conn, $email, $mangaId)
{
    $sql = "DELETE FROM browse WHERE Email = ? AND Manga_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $email, $mangaId);
    mysqli_stmt_execute($stmt);
}

// Check if a delete request was made
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_email']) && isset($_GET['delete_manga_id'])) {
    deleteComment($conn, $_GET['delete_email'], $_GET['delete_manga_id']);
    header("Location: comments.php"); // Redirect back to the page
    exit;
}

$comments = fetchComments($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Comments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Font Awesome for icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

<body>
    <div class="container mt-5">
        <h2>User Comments</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Manga_ID</th>
                    <th scope="col">Customer_Email</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($comment['Manga_ID']); ?></td>
                        <td><?php echo htmlspecialchars($comment['Email']); ?></td>
                        <td><?php echo htmlspecialchars($comment['Comment']); ?></td>
                        <td>
                            <a href="?delete_email=<?php echo urlencode($comment['Email']); ?>&delete_manga_id=<?php echo $comment['Manga_ID']; ?>" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container-fluid text-center">
        <a href="adminhome.php" class="btn btn-primary">Admin Home</a>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>