<?php 
	session_start();
    $title = "My Cart";
    function get_content(){
    require_once '../../controllers/connection.php';
	require_once '../partials/nav.php';
	
?>

<div class="color1">
	<p>.</p>
	<div class="container py-5 margin-tb">
		<?php if(isset($_SESSION["cart"]) && count($_SESSION['cart'])): ?>

		<table class="table table-hover">
			<thead class="table-dark">
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
 				$total = 0;
				foreach($_SESSION['cart'] as $id => $quantity):
				$query = "SELECT * FROM products WHERE products_id = ?";
				$stmt = $cn->prepare($query);
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$product = $result->fetch_assoc();
				$subtotal = floatval($product['price']) * intval($quantity);
				$total += $subtotal;
				?>
				<tr>
					<td><?php echo $product["name"] ?></td>
					<td><?php echo $product["price"] ?></td>
					<td>
						<form action="/controllers/cart/update_cart.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="number" name="quantity" value="<?php echo $quantity ?>" class="quantity_input">
						</form>
					</td>
					<td><?php echo number_format($subtotal, 2); ?></td>
					<td>
						<a href="/controllers/cart/delete_cart_item.php?id=<?php echo $id ?>" class="btn btn-outline-danger">Delete</a>
					</td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td>
						<a href="/controllers/cart/empty_cart.php" class="btn btn-outline-danger">Empty Cart</a>
					</td>
					<td>
						<button class="btn btn-outline-info" data-toggle="modal" data-target="#checkout-modal">Checkout</button>

						<div class="modal fade" id="checkout-modal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Confirm Checkout</h5>
									</div>
									<div class="modal-body">
										<p>Are you really sure about your oders?</p>
										<strong>Total: <?php echo number_format($total, 2) ?></strong>
									</div>
									<div class="modal-footer">
										<button class="btn btn-secondary" data-dismiss="modal">Close</button>
										<a href="/controllers/cart/checkout.php?pid=1" class="btn btn-outline-info">Checkout</a>
									</div>
								</div>
							</div>
						</div>

					</td>
					<td id="paypal-button-container">

					</td>
					<td>Total: <?php echo number_format($total, 2) ?></td>
				</tr>
			</tbody>
		</table>

		<?php else: ?>
			<div class="card text-center margin-tb">
				<div class="card-header">
					<h2>Your cart is empty</h2>
				</div>
				<div class="card-body">
					<a href="homepage.php">Go back to shopping.</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
	

	<script src="https://www.paypal.com/sdk/js?client-id=AbWonYQo0iRbTtpMJLCNowl-pytJuOGoVhwzq3ZbKz_JJmmLqcaurPIx2N-2CEi-A93qq53l3zOTBopA"></script>

	<script>

paypal.Buttons({
	createOrder: function(data, actions) {
		return actions.order.create({
			purchase_units: [{
				amount: { value: <?php echo number_format($total, 2); ?> }
			}]
		})
	},
	onApprove: function(data, actions) {
		return actions.order.capture().then(function(details) {
			alert("Transaction completed by " + details.payer.name.given_name)
			fetch('/controllers/cart/checkout.php?pid=2')
		})
	}
}).render('#paypal-button-container');

</script>

<script type="text/javascript">
	let quantityInputs = document.querySelectorAll('.quantity_input');
	quantityInputs.forEach( input => {
		input.addEventListener('change', () => {
			input.parentElement.submit();
		})
	})
</script>
<?php 
    require_once '../partials/footer.php';
    }
    require_once '../partials/layout.php';
?>