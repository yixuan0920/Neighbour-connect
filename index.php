<?php 
    $title = "Login";
    function get_content(){
?>
<main class="index-main">
    <div class="mt-5 mx-auto">
        <h1 class="text-center mx-auto">Neigbour Connect</h1>
        <hr class="hr-index mx-auto">
    </div>

    <div class="container">
        <div class="row">
            <div id="form1" class="mt-5">

                <form method="POST" action="/controllers/auth/process_login.php" class="text-center">
                    <h2 class="mt-3">Login</h2>
                        <div class="form-group">
                            <p>Username</p>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span><input type="text" name="username" class="form-control" required></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <p>Password</p>
                            <div class="d-flex justify-content-center">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <span><input type="password" name="password" class="form-control" required></span>
                            </div>
                            <button class="btn btn-outline-info mt-3 mb-3">Login</button>
                            <span>or</span>
                            <a href="/views/forms/register.php" class="btn">Register</a>
                        </div>
                </form>
                
            </div>
        </div>
    </div>
</main>
<?php 
    }
    require_once 'views/partials/layout.php';
?>