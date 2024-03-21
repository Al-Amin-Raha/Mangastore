<?php
include('dbConnect.php');
include('navbar.php');
session_start();

$query = "SELECT * FROM manga";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 mb-0 py-5">
      <!-- Section header, if needed -->
    </div>
    <div class="row mx-auto container-fluid">
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img src="<?php echo htmlspecialchars($row['Image']); ?>" alt="<?php echo htmlspecialchars($row['Title']); ?>" class="img-fluid mb-3">
          <h5 class="p-name"><?php echo htmlspecialchars($row['Title']); ?></h5>
          <h4 class="p-price">$<?php echo htmlspecialchars($row['Price']); ?></h4>
          <button class="buy-btn" onclick="window.location.href='single_product.php?manga_id=<?php echo $row['Manga_ID']; ?>'">View</button>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
  <?php include('footer.php'); ?>
</body>

</html>