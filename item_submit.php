<?php
  include_once 'connection.php';

  $item_nameErr = $item_priceErr = $item_quantityErr = $item_descErr = "";

  $item_name = $item_price = $item_quantity = $item_desc = "";

  if(isset($_POST['submit'])) {
    if(!empty($_POST['item_name'])) {
      $item_name = test_input($_POST['item_name']);
    }else{
      $item_nameErr = "Item Name is required";
    }
    if(!empty($_POST['item_price'])) {
      $item_price = test_input($_POST['item_price']);
    }else{
      $item_priceErr = "Item Price is required";
    }
    if(!empty($_POST['item_quantity'])) {
      $item_quantity = test_input($_POST['item_quantity']);
    }else{
      $item_quantityErr = "Initial Stock is required";
    }
    if(!empty($_POST['item_desc'])) {
      $item_desc = test_input($_POST['item_desc']);
    }else{
      $item_descErr = "Item Description is required";
    }
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $sql = "INSERT INTO catalog (item_name, item_price, item_quantity, item_desc)
   VALUES ('$item_name', '$item_price', '$item_quantity', '$item_desc');";
if ($con->query($sql) == TRUE) {
  try {
    $profile_id = mysqli_insert_id($con);
    include 'header.html';
    createHTML();
    include 'footer.html';
  } catch(exception $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}
$con->close();

function createHTML(){
  ?>
  <br>
  <div class="container-fluid">
    <h3>Catalog Successfully Updated!</h3>
    <br>
    <div class="form-check">
      <a href="catalogDisplay.php">
        <button class="btn btn-primary" name="return">
          Go to Catalog</button></a>
      <a href="createItem.php">
      <input class="btn btn-secondary" type="button"
        name="addAnother" value="Return to Item Editor"></a>
    </div>
  </div>
  <br>
  <?php
} ?>
