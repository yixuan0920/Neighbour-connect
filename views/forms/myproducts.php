<?php 
	session_start();
    $title = "My Products";
    function get_content(){
		require_once '../partials/nav.php';
		require_once '../../controllers/connection.php';

	$products_query = "SELECT * FROM products";
	$product_stmt = $cn->prepare($products_query);
	$product_stmt->execute();
	$products_result = $product_stmt->get_result();
	$products = $products_result->fetch_all(MYSQLI_ASSOC);
?>
<div class="color1">
	<p class="hidden disabled">.</p>

	<div class="container p-0 margin-tb">
		<div class="row text-center">
			<h3 class="pb-2"> Upload Product </h3>
			<hr class="hr-index mx-auto">
		</div>

		<div class="row p-0">
			<?php if(isset($_SESSION["user_details"])): ?>
			<form class="py-5 col-md-6 mx-auto card" method="POST" action="../../controllers/products/add_product.php" enctype="multipart/form-data">
				<div class="mb-3 card-body">
					<label>Name</label>
					<input type="text" name="product_name" class="form-control" required>
				</div>

				<div class="mb-3 card-body">
					<label>Price</label>
					<input type="number" name="price" class="form-control" required>
				</div>

				<div class="mb-3 card-body">
					<label>Image</label>
					<input type="file" name="image" class="form-control" required>
				</div>

				<div class='mb-3 card-body'>
					<label>Description</label>
					<textarea class="form-control" name="description" rows="5" required></textarea>
				</div>

				<button class="btn btn-outline-info w-50 mx-auto">Add Product</button>
			</form>
			<?php endif; ?>
		</div>
		
		<div class="row mt-5">
			<h3> Your Products <span class="btn disabled">edit that</span></h3>
			<hr>
			<?php foreach($products as $product): ?>
				<?php if($_SESSION["user_details"]['users_id'] == $product['users_id']): ?>
                <div class="col-md-3 py-5">
                    <div class="card product-h">
                        <img src="<?php echo $product['image'] ?>" class="card-img-top">
                        <div class="card-body mt-border">
							<a href="../product_details.php?id=<?php echo $product['products_id']?>"><h3 class="card-title"><?php echo $product["name"] ?></h3></a>
                            <!-- <hr> -->
							<p class="card-text"><?php echo $product['description'] ?></p>
							<hr>
                            <strong>RM: <?php echo $product['price'] ?></strong>
						</div>			
                    </div>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
</div>

<?php 
    require_once '../partials/footer.php';
    }
    require_once '../partials/layout.php';
?>