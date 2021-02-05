<?php 
    session_start();
    $title = "Bulletin Page";
    function get_content(){
        require_once '../../controllers/connection.php';
        require_once '../partials/nav.php';

    $posts_query = "SELECT * FROM post";
    $post_stmt = $cn->prepare($posts_query);
    $post_stmt->execute();
    $posts_result = $post_stmt->get_result();
    $posts = $posts_result->fetch_all(MYSQLI_ASSOC);

    $bulletins_query = "SELECT * FROM bulletin";
    $bulletin_stmt = $cn->prepare($bulletins_query);
    $bulletin_stmt->execute();
    $bulletins_result = $bulletin_stmt->get_result();
    $bulletins = $bulletins_result->fetch_all(MYSQLI_ASSOC);
?>
<section class="color1">
.
    <div class="container p-0 margin-tb">

        <div class="row text-center">
            <h3 class="pb-2 font-style1"> Bulletin Board </h3>
            <hr class="hr-index mx-auto">
        </div>
        
        <?php foreach($bulletins as $bulletin):?>
        <div class="row border radius3 bg-dark col-md-12">
            <div class="col-md-6 p-2">
                <div >
                    <img src="<?php echo $bulletin['image']?>" class="radius2" style="width: 70%;">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mt-2 text-center border-bottom">
                    <h3 class="text-white font-title"><?php echo $bulletin['title'];?></h3>
                </div>
                
                <div class="mt-5 text-center">
                    <p class="text-white comments"><?php echo $bulletin['description']; ?></p>
                </div>
            </div>
        <?php if(isset($_SESSION['user_details']['users_id']) && $_SESSION['user_details']['isAdmin']):?>
            <div class="text-center border-top">
            <button class="btn btn-outline-warning" data-toggle="modal" data-target="#editModal">Edit</button>

                    <div class="modal fade" id="editModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Item</h5>
                                </div>
                                    user
                                <div class="modal-body">
                                    <form method="POST" action="/controllers/bulletin/edit_post.php" enctype="multipart/form-data">
                                        <input type="hidden" name="bulletin_id" value="<?php echo $bulletin['bulletin_id'] ?>" >

                                        <div class="mb-3">
                                            <label>Title</label>
                                            <input type="text" name="bulletin_title" class="form-control" value="<?php echo $bulletin['title'];?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Image</label>
                                            <input type="file" name="image" value="<?php echo $bulletin['image'];?>" class="form-control" >
                                        </div>

                                        <div class='mb-3'>
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="5" required><?php echo $bulletin['description'];?></textarea>
                                        </div>
                                        <button class="btn btn-outline-info">Update Bulletin</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
        <?php endif;?>

        </div>
        <?php endforeach;?>
    </form>

        <div class="mt-5">
            <h3 class="text-center font-style1"> Leave your Comments </h3>
                <hr class="hr-index mx-auto">
        </div>

        <form method="POST" action="/controllers/bulletin/add_post.php">
            <div class="row mt-5 mx-auto" enctype="multipart/form-data">
                <div class="text-center">
                    <div>
                        <textarea name="comments" class="textarea radius2 w-50" placeholder="Add a comment..." rows="5" required></textarea>
                    </div>
                    <button class="btn btn-outline-info">Post comment</button>
                </div>
            </div>    
        </form>
        

        <article class="mt-5 w-50 mx-auto">

            <div class="border-white radius1 mx-auto pt-3 bg-dark text-white">
                <div class="mx-auto" style="width: 80%;">
                    <?php foreach($posts as $post):?>

                    <?php
                            $users_query = "SELECT * FROM users WHERE users_id = ?";
                            $user_stmt = $cn->prepare($users_query);
                            $user_stmt->bind_param('i', $post['users_id']);
                            $user_stmt->execute();
                            $users_result = $user_stmt->get_result();
                            $user = $users_result->fetch_assoc();
                        ?>
                    <strong>
                        <?php echo $user['name']; ?>
                    </strong>
                    <br>
                    <p class="comments">
                    <?php echo $post['comments'];?>
                    </p>
                       
                    <div class="text-center">
                        <?php if($_SESSION['user_details']['users_id'] == $post['users_id']):?>
                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                            <?php endif;?>

                            
                        <div class="modal fade" id="deleteModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title color-b">Are you sure you want to delete this post?</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                        <a class="btn btn-outline-danger" href="/controllers/bulletin/delete_comment.php?id=<?php echo $post['post_id'] ?>">Confirm</a>
                                    </div>
                                </div>
                            </div>
                        </div>   

                        <small>
                            . <?php echo $post['purchase_date']; ?>
                        </small>
                    </div>
                    <hr class="w-50 mx-auto">
                        <?php endforeach;?>
                </div>
            </div>
        </article>

        <?php //if(isset($_SESSION['user_details']['users_id']) && $_SESSION['user_details']['isAdmin']):?>
        <div class="text-center mt-5">
            <!-- <button class="btn btn-danger w-50">Delete This Page</button> -->
        </div>
        <?php //endif;?>

    </div>

<?php 
    require_once '../partials/footer.php';
    }
    require_once '../partials/layout.php';
?>