<?php

$title = "Product Details";

function get_content() {
    require_once 'partials/nav.php';
	require_once '../controllers/connection.php';
	$id = $_GET['id'];
	$query = "SELECT * FROM products WHERE products_id = ?";
	$stmt = $cn->prepare($query);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$product = $result->fetch_assoc();

?>

<div class="color1">
<p>.</p>
<div class="container margin-tb">
	<div class="row">
		<div class="col-md-4 py-5 mx-auto">
			<div class="card product-h">
				<img src="<?php echo $product['image'] ?>" class="card-img-top">
				<div class="card-body mt-border">
					<h5 class="card-title"><?php echo $product["name"] ?></h5>
					<p class="card-text"><?php echo $product['description'] ?></p>
					<hr>
					<strong>RM: <?php echo $product['price'] ?></strong>
				</div>

				<?php //if(isset($_SESSION["user_details"]) && !$_SESSION["user_details"]["isAdmin"]): ?>
				<?php //endif; ?>

				<?php //if(isset($_SESSION["user_details"]) && $_SESSION["user_details"]["isAdmin"]): ?>
				<div class="card-footer">
					<button class="btn btn-outline-warning" data-toggle="modal" data-target="#editModal">Edit</button>

					<div class="modal fade" id="editModal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Edit Item</h5>
								</div>

								<div class="modal-body">
									<form method="POST" action="/controllers/products/update_product.php" enctype="multipart/form-data">
										<input type="hidden" name="product_id" value="<?php echo $product['products_id'] ?>">

										<div class="mb-3">
											<label>Name</label>
											<input type="text" name="product_name" class="form-control" value="<?php echo $product['name'] ?>" required>
										</div>

										<div class="mb-3">
											<label>Price</label>
											<input type="number" name="price" class="form-control" value="<?php echo $product['price'] ?>" required>
										</div>

										<div class="mb-3">
											<label>Image</label>
											<input type="file" name="image" class="form-control" value="<?php echo $product['image'] ?>">
										</div>

										<div class='mb-3'>
											<label>Description</label>
											<textarea class="form-control" name="description" rows="5" required><?php echo $product['description'] ?></textarea>
										</div>
										<button class="btn btn-outline-info">Update Product</button>
									</form>
								</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>

					<button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>

					<div class="modal fade" id="deleteModal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Are you sure you want to delete <?php echo $product['name'] ?> ?</h5>
								</div>
								<div class="modal-footer">
									<button data-dismiss="modal" class="btn btn-secondary">Cancel</button>
									<a class="btn btn-outline-danger" href="/controllers/products/delete_product.php?id=<?php echo $product['products_id'] ?>">Confirm</a>
								</div>
							</div>
						</div>
					</div>

				</div>
				<?php //endif; ?>

				<?php //if(isset($_SESSION['user_details']) && $_SESSION['user_details']->isAdmin) :?>
						<!-- <div class="card">
							<a
								href="../../controllers/products/activate_deactivate.php?id=<?php echo $id ?>"
								class="btn btn-<?php //$value->isActive ? print("secondary") : print('primary')?>">
								<?php //$value->isActive ? print('Deactivate') : print('Activate')?>
							</a>
						</div> -->
				<?php //endif; ?>

			</div>
		</div>
	</div>
</div>
				
<?php
require_once 'partials/footer.php' ;
}
require_once 'partials/layout.php';
?>