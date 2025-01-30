<?php
$page_title = 'Manipulate Catalog';
include ('header.html');
include 'connection.php';
if( (isset($_SESSION['user_id'])) && ($_SESSION['user_level'] != 2)){
	header("Location: index.php");
	die();
}
?>
<div class="container-fluid">
	<form name="Item Editor" id="myform" method="POST" action="item_submit.php" enctype="multipart/form-data">
		<br>
		<input type="hidden" id="changed" name="changed" value="yes" />
		<div class="border border-info" style="background-color: #5bc0de;">
			<div class="form-check" style="padding: 20px;">
				<h1>Create New Catalog Item</h1>
				<div class="form-inline">
					<div class="form-group">
						<label class="sr-only" for="item_name">Item Name</label>
						<input required  name="item_name" id="item_name" type="text" class="form-control" placeholder="Item Name" style="width: 20vw;" value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?>">
					</div>
				</div>
				<br>
				<div class="form-inline">
					<div class="form-group">
						<label class="sr-only" for="item_price">Price</label>
						<input required name="item_price" id="item_price" type="number" step="0.01" class="form-control" style="width: 10vw;" placeholder="Item Price" value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price']; ?>">
						<label class="sr-only" for="item_quantity">Initial Stock</label>
						<input required name="item_quantity" id="item_quantity" type="number" class="form-control" style="width: 10vw;" placeholder="Initial Stock" value="<?php if (isset($_POST['item_quantity'])) echo $_POST['item_quantity']; ?>">
					</div>
				</div>
				<br>
				<div class="form-inline">
					<div class="form-group" style="padding-bottom: 20px;">
						<label class="sr-only" for="item_desc">Item Description</label>
						<textarea required name="item_desc" id="item_desc" type="text" class="form-control" style="width: 20vw; height: 35vh;" placeholder="Description" value="<?php if (isset($_POST['item_desc'])) echo $_POST['item_desc']; ?>"></textarea>
					</div>
				</div>
			</div>
		</div>
		<br>
	<div class="border border-info">
		<div class="form-check">
			<br>
			<button class="btn btn-primary" type="submit" name="submit">Submit</button>
			<a href="index.php"><input class="btn btn-secondary" type="button" value="Cancel and Exit"></a>
		</div>
		<br>
	</form>
	</div>
</div>
<?php
include ('footer.html');
$con->close();
?>
