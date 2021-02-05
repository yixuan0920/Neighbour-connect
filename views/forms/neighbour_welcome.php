<?php 
    session_start();
    $title = "Welcome page";
    function get_content(){
    require_once '../../controllers/connection.php';
    require_once '../partials/nav.php';
?>

.
	<div class="container margin-tb">

		<div class="row">
			<h3 class="text-center font-style1">Neighbour Connect | </h3>
			<span class="text-center">Tutorial</span>
		</div>

		<div class="border border-wel w-50 mx-auto">
			<div class=" container">
				<div class="row">
					<div class="col-md-4 mt-2">
						<a href="myproducts.php" target="_blank"><img src="../../assets/bgimg/t1.PNG" class="img-r"></a>
					</div>
					<div class="col-md-8">
						<p>1. <strong>My Product</strong></p>
						<p style="font-size: 15px;">- Upload Your own Product</p>
						<p style="font-size: 15px;">- Edit Your own Product</p>
					</div>
					<hr>

					<div class="col-md-4">
						<a href="mycart.php" target="_blank"><img src="../../assets/bgimg/t2.PNG" class="img-r"></a>
					</div>
					<div class="col-md-8">
						<p>2. <strong>My Cart</strong></p>
						<p style="font-size: 15px;">- If you <u>Add</u> some product, it will jump to here.
						And then you can check it out.</p>
					</div>
					<hr>

					<div class="col-md-4">
						<a href="#"><img src="../../assets/bgimg/t3.PNG" class="img-r"></a>
					</div>
					<div class="col-md-8">
						<p>3. <strong>Order</strong></p>
						<a href="transactions.php" target="_blank"><img src="../../assets/bgimg/t31.PNG" class="img-r" style="width: 20%;"></a>
						<p style="font-size: 15px;">
							- If aother Neighbour <u>check out</u> your product,it will jump here.
							<br>
							- You can <u>Accept</u> or <u>Cancel</u> the product.
						</p>
						<a href="my_transaction.php" target="_blank"><img src="../../assets/bgimg/t32.PNG" class="img-r" style="width: 20%;"></a>
						<p style="font-size: 15px;">
							- If you checked out the product that will jump here.
							<br>
							- You can <u>Cancel</u> it or wait owner to <u>Accept</u> that.
						</p>
					</div>
					<hr>

				</div>
			</div>
		</div>
		
	<div class="bg-nei">
		<div class="row mt-5 pt-5">
			<h3 class="text-center font-style1">Benefits</h3>
			<hr class="hr12 mx-auto">
		</div>				

		<div class="row mt-5">
			<div class="col-md-6 text-center">
				<img src="../../assets/bgimg/eazy.jpg" class="shadow1"  data-aos="zoom-in-right">
				<h3 class="font-style1">Eazy to Use</h3>
			</div>

			<div class="col-md-6 text-center">
				<img src="../../assets/bgimg/people.png" class="shadow1"  data-aos="zoom-in-left">
				<h3 class="text-center">Sell own Item</h3>
			</div>

			<div class="col-md-12 text-center mt-5">
				<img src="../../assets/bgimg/discuss.jpg" class="shadow1"  data-aos="zoom-out">
				<h3 class="font-style1" >Discussion</h3>
			</div>
		</div>

		<div class="row">
			<div class="text-center">
				<button class="btn font-c font-style1"><a href="homepage.php">歡迎-Welcome-Salamat</button></a>
				<h1 class="color-b w-100 animate__animated animate__rubberBand">To Neighbour Connect</h1>
			</div>
		</div>

		</div>
	</div>



<?php 
    require_once '../partials/footer.php';
    }
    require_once '../partials/layout.php';
?>