<?php
include("includes/db.php");

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE id='$id'";
$result = mysqli_query($conn,$query);

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>

<title><?php echo $product['name']; ?></title>

<link rel="stylesheet"
href="assets/css/style.css">

</head>

<body>

<h1><?php echo $product['name']; ?></h1>

<div class="viewer-container">

<img id="viewer"
src="uploads/frames360/product-<?php echo $id; ?>/1.webp">

</div>

<script>

let frame = 1;
let totalFrames = 36;

document.addEventListener("mousemove", function(e){

    frame++;

    if(frame > totalFrames){
        frame = 1;
    }

    document.getElementById("viewer").src =
    "uploads/frames360/product-<?php echo $id; ?>/" + frame + ".webp";
});

</script>

</body>
</html>