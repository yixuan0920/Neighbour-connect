<?php 
    $title = "Login";
    function get_content(){
?>
<main class="index-main">
    <div class="mt-5 mx-auto">
        <h1 class="text-center mx-auto">Neigbour Shop</h1>
        <hr class="hr-index mx-auto">
    </div>

    <div class="container">
        <div class="row">
            <div id="form1" class="mt-5">

                <form method="POST" action="/controllers/auth/process_register.php" class="text-center">
                    <h2 class="mt-3">Register</h2>
                        <div class="form-group">
                            <p>Name</p>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <span><input type="text" name="name1" class="form-control" required></span>
                            </div>

                            <p>Username</p>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <span><input type="text" name="username" class="form-control" required></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <p>Password</p>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <span><input type="password" name="password" class="form-control" required></span>
                            </div>

                            <p>Confirm Password</p>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <span><input type="password" name="password2" class="form-control" required></span>
                        </div>

                        <div class="form-group">
                            <p>Address</p>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span><input type="text" name="address" class="form-control" required></span>
                            </div>
                        </div>

                            <button class="btn btn-outline-info mt-3 mb-3">Register</button>
                            <span>or</span>
                            <a href="../../index.php" class="btn">Login</a>
                        </div>
                </form>
                
            </div>
        </div>
    </div>
</main>
<?php 
    }
    require_once '../partials/layout.php';
?>