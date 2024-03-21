<?php
include('dbConnect.php');
include('navbar.php');
session_start();

if (!isset($_GET['manga_id'])) {
  header("Location: errorPage.php");
  exit;
}

$manga_id = $_GET['manga_id'];

// Fetch manga details
$query = "SELECT * FROM manga WHERE Manga_ID = ?";
if ($stmt = mysqli_prepare($conn, $query)) {
  mysqli_stmt_bind_param($stmt, "i", $manga_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $manga = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);

  if (!$manga) {
    header("Location: errorPage.php");
    exit;
  }
} else {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit;
}

// Handle Buy Now action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buy_now'])) {
  // Check if the user is logged in
  if (isset($_SESSION['email'])) { // Assuming 'email' is used to check if the user is logged in
    $quantity = 1; // Set a default quantity or get it from user input
    $price = $manga['Price'];
    $email = $_SESSION['email']; // Assuming user's email is stored in session
    $mangaId = $manga['Manga_ID'];

    $insertOrderQuery = "INSERT INTO order_details (Quantity, Price, C_Email, Manga_ID) VALUES (?, ?, ?, ?)";
    if ($insertOrderStmt = mysqli_prepare($conn, $insertOrderQuery)) {
      mysqli_stmt_bind_param($insertOrderStmt, "iisi", $quantity, $price, $email, $mangaId);
      mysqli_stmt_execute($insertOrderStmt);
      mysqli_stmt_close($insertOrderStmt);

      header("Location: cart.php"); // Redirect to cart.php
      exit;
    } else {
      echo "Error preparing statement: " . mysqli_error($conn);
    }
  } else {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
  }
}

// Handle Comment Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
  $comment = $_POST['comment'];
  $rating = $_POST['rating'];

  // Assuming the user's email is stored in $_SESSION['email']
  $email = $_SESSION['email'];

  // Insert comment into the browse table
  $insertCommentQuery = "INSERT INTO browse (Manga_ID, Email, Rating, Comment) VALUES (?, ?, ?, ?)";
  if ($insertCommentStmt = mysqli_prepare($conn, $insertCommentQuery)) {
    mysqli_stmt_bind_param($insertCommentStmt, "isis", $manga_id, $email, $rating, $comment);
    mysqli_stmt_execute($insertCommentStmt);
    mysqli_stmt_close($insertCommentStmt);

    // Optionally, refresh the page to show the new comment
    header("Location: " . $_SERVER['PHP_SELF'] . "?manga_id=" . $manga_id);
    exit;
  } else {
    echo "Error preparing statement: " . mysqli_error($conn);
  }
}
// Fetch comments
$commentQuery = "SELECT * FROM browse WHERE Manga_ID = ?";
$comments = [];
if ($commentStmt = mysqli_prepare($conn, $commentQuery)) {
  mysqli_stmt_bind_param($commentStmt, "i", $manga_id);
  mysqli_stmt_execute($commentStmt);
  $commentResult = mysqli_stmt_get_result($commentStmt);
  while ($row = mysqli_fetch_assoc($commentResult)) {
    $comments[] = $row;
  }
  mysqli_stmt_close($commentStmt);
}
// Fetch manga details with category
$query = "SELECT manga.*, category.Category_Name FROM manga INNER JOIN category ON manga.Cat_ID_M = category.Category_ID WHERE Manga_ID = ?";
if ($stmt = mysqli_prepare($conn, $query)) {
  mysqli_stmt_bind_param($stmt, "i", $manga_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $manga = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);

  if (!$manga) {
    header("Location: errorPage.php");
    exit;
  }
} else {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Single Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <section class="container single-product my-5 pt-5">
    <div class="row mt-5">
      <div class="col-lg-5 col-md-6 col-sm-12">
        <img class="img-fluid w-100 pb-1" src="<?php echo htmlspecialchars($manga['Image']); ?>" id="mainImg">
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <h3 class="py-4">Title: <?php echo htmlspecialchars($manga['Title']); ?></h3>
        <h5 class="py-1">Category: <?php echo htmlspecialchars($manga['Category_Name']); ?></h5>
        <h2>Price: $<?php echo htmlspecialchars($manga['Price']); ?></h2>
        <h4 class="py-4">Mangaka: <?php echo htmlspecialchars($manga['Mangaka']); ?></h4>
        <p>Description: <?php echo htmlspecialchars($manga['Description']); ?></p>
        <div>
          <form action="" method="post">
            <input type="hidden" name="buy_now" value="true">
            <button type="submit">Buy Now</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section id="comments" class="container my-5">
    <h3>Comments and Ratings</h3>
    <form action="" method="post">
      <div class="mb-3">
        <label for="rating" class="form-label">Rating:</label>
        <select name="rating" class="form-select" id="rating">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label">Comment:</label>
        <textarea name="comment" class="form-control" id="comment" rows="3" placeholder="Add a comment..." required></textarea>
      </div>
      <button type="submit" class="btn comment-submit-btn btn-primary">Submit</button>
    </form>
    <?php foreach ($comments as $comment) : ?>
      <div class="comment">
        <p>
          <strong><?php echo htmlspecialchars($comment['Email']); ?></strong>
          (Rating: <?php echo htmlspecialchars($comment['Rating']); ?>):
          <?php echo htmlspecialchars($comment['Comment']); ?>
        </p>
      </div>
    <?php endforeach; ?>
  </section>

  <?php include('footer.php'); ?>
</body>

</html>