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
<div class="color1">
    <header class="h-img">
        <div class="container">
            <div class="row">
                <h1 class="position-a text-center h1-b"><marquee>Welcome To Neigbour Connect, <?php echo $_SESSION['user_details']['name'];?></marquee></h1>
            </div>
        </div>
    </header>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 bg-color mx-auto">

                <h3 class="text-center"> Hot News </h3>
                <hr class="hr-index mx-auto">
                <div>
                    <div class="w3-content w3-section mx-auto" style="max-width:500px">
                        <a href="https://www.theedgemarkets.com/article/covid19-malaysia-records-3585-new-cases-11-deaths">
                            <img class="mySlides radius-img" src="../../assets/bgimg/covid.jpg" style="width:100%" alt="COVID-19">
                        </a>

                        <a href="https://www.independent.co.uk/life-style/gadgets-and-tech/bitcoin-price-latest-b1784101.html">
                            <img class="mySlides radius-img" src="../../assets/bgimg/bit.jpg" style="width:100%" alt="BITCOIN">
                        </a> 
                        <div>
                            <p class="btn disabled">Click Read More...</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- <div class="container">
        <div class="row">
            <div class="slider-for">
                <div>your content</div>
                <div>your content</div>
                <div>your content</div>
            </div>
        </div>
    </div> -->
    
    <div class="container">
        
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="text-center">
                <h3 class="">Your Neigbour Products </h3>
                <hr class="hr-index mx-auto">
            </div>

            
            <?php foreach($products as $product): ?>
                <?php if($_SESSION["user_details"]['users_id'] != $product['users_id']): ?>
                <div class="col-md-3 py-5">
                    <?php //foreach($users as $user):
                            $users_query = "SELECT * FROM users WHERE users_id = ?";
                            $user_stmt = $cn->prepare($users_query);
                            $user_stmt->bind_param('i', $product['users_id']);
                            $user_stmt->execute();
                            $users_result = $user_stmt->get_result();
                            $user = $users_result->fetch_assoc();
                        ?>

                        <?php //if($_SESSION["user_details"]['users_id'] == $user['users_id']): ?>
                <p class="btn disabled mx-auto"><?php echo $user['name']; ?>'s product</p>
                        <?php //endif;?>
                        <?php //endforeach; ?>
                        
                    <div class="card product-h">
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
    </div>

    <!-- <div class="container mt-5">
        <div class="row">
        <div class="d-flex justify-content-center">
            <div class="col-md-6">
                <div class="w-100">
                    <img src="../../assets/bgimg/washhand.jpg" class="img-w">
                </div>
            </div>

            <div class="col-md-6">
                <div class="w-100">
                    <img src="../../assets/bgimg/wearm.jpg" class="w-50">
                </div>
            </div>
        </div>
        </div>
    </div> -->

    <!-- <div class="container mt-5">
        <div class="row">
                <div class="w-100">
                    <img src="../../assets/bgimg/washhand.jpg" class="img-w">
                </div>
            </div>
        </div>
    </div> -->


        <!-- <div class="row">
            <h5> Neigbour Skills </h5>
            <hr class="hr-index mx-auto">
        </div> -->


    <!-- <div class="container">
        <div class="row">
    <div class="col-lg-6">
        <h1>hello</h1>
    </div>
    <div class="col-lg-6">
        <h1>hello</h1>
    </div>
    </div>
    </div> -->
    <!-- </div> -->

<script type="text/javascript">
let addToCartButtons = document.querySelectorAll('.add-to-cart');
addToCartButtons.forEach((indiv_button, i) => {
    indiv_button.addEventListener('click', () => {
        let id = indiv_button.getAttribute("data-id")
        let quantity = indiv_button.previousElementSibling.value

        // alert("Item id: " + id + " quantity added: " + quantity);
        let formBody = new FormData;
        formBody.append('id', id);
        formBody.append('quantity', quantity);

        //fetch("url", options)
        fetch("/controllers/cart/add_to_cart.php", {
            method: "POST",
            body: formBody
        })
        .then(res => res.text())
        .then(data => {
            let cartCount = document.getElementById('cart_count')
            if(cartCount.innerHTML != "") {
                cartCount.innerHTML = parseInt(cartCount.innerHTML) + parseInt(quantity);
            } else {
                cartCount.innerHTML = parseInt(quantity);
            }
        })
    })
})

</script>
<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>

<script type="text/javascript">
    
 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: true,
  centerMode: true,
  focusOnSelect: true
});
  </script>
<?php 
    require_once '../partials/footer.php';
    }
    require_once '../partials/layout.php';
?>