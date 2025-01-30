<?php
$page_title = 'Manipulate Catalog';
include ('header.html');
include 'connection.php';
$item_name = $item_price = $item_quantity = $item_desc = $item_id ="";
if( (isset($_SESSION['user_id'])) && ($_SESSION['user_level'] != 2)){
	header("Location: index.php");
	die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$item_id = $_POST["item_id"];
	header("Location: ?id=" . $item_id);
  die();
}
if (isset($_GET['id'])) {
	$item_id = $_GET['id'];
	if (is_numeric($item_id)){
		$q = "SELECT * FROM catalog WHERE item_id = $item_id";
		$r = @mysqli_query ($con, $q);
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			$item_name = $row['item_name'];
			$item_price =  $row['item_price'];
			$item_quantity =  $row['item_quantity'];
			$item_desc =  $row['item_desc'];
		}
		echo '
		<div class="container-fluid">
			<form name="Item Editor" id="myform" method="POST" action="item_update.php?id=' . $item_id . '" enctype="multipart/form-data">
				<br>
				<input type="hidden" id="changed" name="changed" value="yes" />
				<div class="border border-info" style="background-color: #5bc0de;">
					<div class="form-check" style="padding: 20px;">
						<h1>Edit Catalog Item ' .$item_id . '</h1>
						<div class="form-inline">
							<div class="form-group">
								<label class="sr-only" for="item_name">Item Name</label>
								<input required  name="item_name" id="item_name" type="text" class="form-control" placeholder="Item Name" style="width: 20vw;" value="' . $item_name . '">
							</div>
						</div>
						<br>
						<div class="form-inline">
							<div class="form-group">
								<label class="sr-only" for="item_price">Price</label>
								<input required name="item_price" id="item_price" type="number" step="0.01" class="form-control" style="width: 10vw;" placeholder="Item Price" value="' . $item_price . '">
								<label class="sr-only" for="item_quantity">Initial Stock</label>
								<input required name="item_quantity" id="item_quantity" type="number" class="form-control" style="width: 10vw;" placeholder="Initial Stock" value="' . $item_quantity . '">
							</div>
						</div>
						<br>
						<div class="form-inline">
							<div class="form-group" style="padding-bottom: 20px;">
								<label class="sr-only" for="item_desc">Item Description</label>
								<textarea required name="item_desc" id="item_desc" type="text" class="form-control" style="width: 20vw; height: 35vh;" placeholder="Description">' . $item_desc . '</textarea>
							</div>
						</div>
					</div>
				</div>
				<br>
			<div class="border border-info">
				<div class="form-check">
					<br>
					<button class="btn btn-primary" type="submit" name="submit">Update</button>
					<a href="catalogDisplay.php"><input class="btn btn-secondary" type="button" value="Return to Catalog"></a>
				</div>
				<br>
			</form>
			</div>
		</div>
		';
	}else{
		echo '
		<form name="Item Editor" id="myform" method="POST" action="editItem.php?id=' . $item_id . '" enctype="multipart/form-data">
		<label for="item_id">Enter the ID of the item you want to Edit, or select the ID from the catalog page</label>
		<input required name="item_id" id="item_id" type="number" class="form-control" style="width: 10vw;"
		placeholder="Enter item ID"
		value="Enter item ID">
		<button style="margin-top:5px;" class="btn btn-primary" type="submit" name="submit">Select</button>
		</form>';
	}
}
include ('footer.html');
$con->close();
?>
