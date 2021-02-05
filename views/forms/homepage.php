<?php 
    session_start();
    $title = "Home Page";
    function get_content(){
    require_once '../../controllers/connection.php';
    require_once '../partials/nav.php';

	$products_query = "SELECT * FROM products";
	$product_stmt = $cn->prepare($products_query);
	$product_stmt->execute();
	$products_result = $product_stmt->get_result();
    $products = $products_result->fetch_all(MYSQLI_ASSOC);

    // $users_query = "SELECT * FROM users";
    // $user_stmt = $cn->prepare($users_query);
    // $user_stmt->execute();
    // $users_result = $user_stmt->get_result();
    // $users = $users_result->fetch_all(MYSQLI_ASSOC);
?>
<section class="color1">
    <header class="h-img">
        <div class="container">
            <div class="row">
                <h1 class="position-a text-center h1-b"><marquee>Welcome To Neigbour Connect, <?php echo $_SESSION['user_details']['name'];?></marquee></h1>
            </div>
        </div>
    </header>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 bg-color mx-auto" >

                <h3 class="text-center font-style1"> Hot News </h3>
                <hr class="hr-index mx-auto">
                <div  data-aos="zoom-in">
                    <div class="w3-content w3-section mx-auto" style="max-width:500px">
                        <a href="https://www.theedgemarkets.com/article/covid19-malaysia-records-3585-new-cases-11-deaths">
                            <img class="mySlides radius-img" src="../../assets/bgimg/covid.jpg" style="width:100%" alt="COVID-19">
                        </a>

                        <a href="https://www.independent.co.uk/life-style/gadgets-and-tech/bitcoin-price-latest-b1784101.html">
                            <img class="mySlides radius-img" src="../../assets/bgimg/bit.jpg" style="width:100%" alt="BITCOIN">
                        </a> 
                        <div>
                            <p class="btn disabled">Click to Discuss...</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="text-center">
                <h3 class="font-style1">Your Neigbour Products </h3>
                <hr class="hr-index mx-auto">
            </div>

            
            <?php foreach($products as $product): ?>
                <?php if($_SESSION["user_details"]['users_id'] != $product['users_id']): ?>
                <div class="col-md-3 py-5">
                        <?php
                            $users_query = "SELECT * FROM users WHERE users_id = ?";
                            $user_stmt = $cn->prepare($users_query);
                            $user_stmt->bind_param('i', $product['users_id']);
                            $user_stmt->execute();
                            $users_result = $user_stmt->get_result();
                            $user = $users_result->fetch_assoc();
                        ?>
                        
                        <p class="btn disabled mx-auto"><?php echo $user['name']; ?>'s product</p>
        
                        
                    <div class="card product-h" data-aos="flip-up">
                        <img src="<?php echo $product['image'] ?>" class="card-img-top">
                        <div class="card-body mt-border">
                            <!-- <a href="../product_details.php?id=<?php //echo $product['products_id']?>"> -->
                            <h3 class="card-title text-color1"><?php echo $product["name"] ?></h3>
                            <!-- </a> -->
                            <!-- <hr> -->
							<p class="card-text"><?php echo $product['description'] ?></p>
							<hr>
                            <strong>RM: <?php echo $product['price'] ?></strong>
						</div>
						
						
                        <div class="card-footer footer-color">
                            <div class="input-group">
                                <input type="number" name="quantity" class="form-control" min="1">
                                <button class="btn btn-outline-warning add-to-cart" data-id="<?php echo $product['products_id'] ?>">Add to Cart</button>
                            </div>
                        </div>
						
                    </div>
                </div>
                <?php endif; ?>
			<?php endforeach; ?>

        </div>
    </div>

</section>
    
<?php 
    require_once '../partials/footer.php';
    }
    require_once '../partials/layout.php';
?>