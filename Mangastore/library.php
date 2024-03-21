<?php
include 'dbConnect.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminlogin.php'); // Redirect to admin login page
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extracting data from POST
    $title = mysqli_real_escape_string($conn, $_POST['Title']);
    $mangaka = mysqli_real_escape_string($conn, $_POST['Mangaka']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);
    $price = (float)mysqli_real_escape_string($conn, $_POST['Price']);
    $adminId = (int)mysqli_real_escape_string($conn, $_POST['Admin_ID_M']);
    $catId = (int)mysqli_real_escape_string($conn, $_POST['Cat_ID_M']);
    if (isset($_FILES['Manga_image']) && $_FILES['Manga_image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Manga_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["Manga_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["Manga_image"]["tmp_name"], $target_file)) {
                // File is uploaded successfully
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $target_file = ''; // Default image path or error handling
    }
    $query = "INSERT INTO manga (Title, Mangaka, Description, Price, Image, Admin_ID_M, Cat_ID_M) VALUES ('$title', '$mangaka', '$description', $price, '$target_file', $adminId, $catId)";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = 'Manga added successfully.';
    } else {
        $_SESSION['error'] = 'Error: ' . mysqli_error($conn);
    }

    header('Location: library.php'); // Redirect back to the form page
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>library</title>

    <!-- Bootstrap CSS components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>

    <div id="log" class="container">
        <h1 class="my-4 text-center">Update Library</h1>
        <form action="library.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input required name="Title" type="text" class="form-control" id="Title">
            </div>
            <div class="mb-3">
                <label for="Mangaka" class="form-label">Mangaka</label>
                <input required name="Mangaka" type="text" class="form-control" id="Mangaka">
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <input required name="Description" type="text" class="form-control" id="Description">
            </div>
            <div class="mb-3">
                <label for="Price" class="form-label">Price</label>
                <input required name="Price" type="number" class="form-control" id="Price">
            </div>
            <div class="mb-3">
                <label for="Manga_image" class="form-label">Cover</label>
                <input type="file" name="Manga_image" required>
            </div>
            <div class="mb-3">
                <label for="Admin_ID_M" class="form-label">Admin ID</label>
                <input required name="Admin_ID_M" type="number" class="form-control" id="Admin_ID_M">
            </div>
            <div class="mb-3">
                <label for="Cat_ID_M" class="form-label">Category ID</label>
                <input required name="Cat_ID_M" type="number" class="form-control" id="Cat_ID_M">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            <?php if (isset($_SESSION['success'])) : ?>
                alert("<?php echo $_SESSION['success']; ?>");
                <?php unset($_SESSION['success']); // Clear the session variable 
                ?>
            <?php endif; ?>
        });
    </script>
    <div class="container-fluid text-center">
        <a href="adminhome.php" class="btn btn-primary">Admin Home</a>
    </div>
</body>

</html>