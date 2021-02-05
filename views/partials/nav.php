<nav class="navbar navbar-expand-lg navbar-light navbar-color position-r stroke" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="../forms/neighbour_welcome.php">
            <!-- <i class="fa fa-handshake-o" aria-hidden="true"></i> -->
            <h6>NEIGHBOUR</h6>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse"  id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="/views/forms/homepage.php">Home</a></li>

            <li class="nav-item">
                <a class="nav-link" href="/views/forms/myproducts.php">My Products</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/views/forms/mycart.php">My Cart
                <span class="badge bg-white text-color" id="cart_count">
                    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])): ?>
                    <?php echo array_sum($_SESSION["cart"]) ?>
                    <?php else: ?>
                        0</li>
                    <?php endif; ?>
                </span>
                </a>

            <li class="nav-item">
                <a href="/views/forms/post.php" class="nav-item nav-link">Bulletin Board</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="../forms/transactions.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">Orders</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="nav-item dropdown-item nav-link" href="../forms/transactions.php">Transaction</a>
                    <li><a class="nav-item dropdown-item nav-link" href="../forms/my_transaction.php">My Orders</a></li>
                </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="../../controllers/auth/logout.php">Logout</a></li>
        </ul>
        </div>
    </div>
</nav>

<script type="text/javascript">

    var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;

    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
    } else {
        document.getElementById("navbar").style.top = "-50px";
    }
    prevScrollpos = currentScrollPos;
    }
</script>

