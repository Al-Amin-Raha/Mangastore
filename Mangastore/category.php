<?php
include 'dbConnect.php';
session_start();

// Fetch existing categories
function fetchCategories($conn)
{
    $sql = "SELECT Category_ID, Category_Name FROM category";
    $result = mysqli_query($conn, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $categories;
}

// Update category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Category_ID']) && isset($_POST['Category_Name'])) {
    $categoryId = $_POST['Category_ID'];
    $categoryName = $_POST['Category_Name'];

    $updateSql = "UPDATE category SET Category_Name = ? WHERE Category_ID = ?";
    $stmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($stmt, "si", $categoryName, $categoryId);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $_SESSION['success'] = "Category updated successfully";
    } else {
        $_SESSION['error'] = "Error updating category";
    }

    mysqli_stmt_close($stmt);
}

// Insert new category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['New_Category_Name'])) {
    $newCategoryName = $_POST['New_Category_Name'];
    $adminId = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null; // Check if admin_id is set

    // Check if the category already exists
    $checkSql = "SELECT COUNT(*) FROM category WHERE Category_Name = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "s", $newCategoryName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($count == 0 && $adminId !== null) {
        $insertSql = "INSERT INTO category (Category_Name, Admin_ID_Cat) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insertSql);
        mysqli_stmt_bind_param($stmt, "si", $newCategoryName, $adminId);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['success'] = "New category added successfully";
        } else {
            $_SESSION['error'] = "Error adding new category";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Category already exists or admin ID is not set";
    }
}

$categories = fetchCategories($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Category</title>

    <!-- Bootstrap CSS components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <div id="log" class="container">
        <h1 class="my-4 text-center">Update Category</h1>

        <!-- Form for updating existing categories -->
        <form action="category.php" method="post">
            <div class="mb-3">
                <label for="Category_ID" class="form-label">Select Category</label>
                <select name="Category_ID" class="form-control" id="Category_ID">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['Category_ID']; ?>">
                            <?php echo $category['Category_Name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Category_Name" class="form-label">New Category Name</label>
                <input required name="Category_Name" type="text" class="form-control" id="Category_Name">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <!-- Form for adding new categories -->
        <div class="my-4">
            <h2>Add New Category</h2>
            <form action="category.php" method="post">
                <div class="mb-3">
                    <label for="New_Category_Name" class="form-label">New Category Name</label>
                    <input required name="New_Category_Name" type="text" class="form-control" id="New_Category_Name">
                </div>
                <button type="submit" class="btn btn-success">Add New Category</button>
            </form>
        </div>
    </div>
    <div class="container-fluid text-center">
        <a href="adminhome.php" class="btn btn-primary">Admin Home</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Additional JavaScript can be added here
    </script>
</body>

</html>


</html>