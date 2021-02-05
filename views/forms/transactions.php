<?php 
    session_start();
    $title = "All Transactions";
    if(!isset($_SESSION["user_details"]) && !$_SESSION["user_details"]["isAdmin"]){
        header("Location: /");
    }
    function get_content(){
      require_once '../../controllers/connection.php';
      require_once '../partials/nav.php';
      
      $query = "SELECT * FROM orders";
      $stmt = $cn->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();
      $orders = $result->fetch_all(MYSQLI_ASSOC);

      $users_query = "SELECT * FROM users";
      $user_stmt = $cn->prepare($users_query);
      $user_stmt->execute();
      $users_result = $user_stmt->get_result();
      $users = $users_result->fetch_all(MYSQLI_ASSOC);
?>
<div class="color1">
.
<div class="container mt-5">
    <div class="row">
        <h2 class="mt-5 text-center font-style1"> Transactions </h2>
        <hr>
        <div class="col-md-8 mx-auto">
            <div class="text-white d-flex pt-5 justify-content-between">
                <div class="p-4 bg-info radius1 font-style1">Pending</div>
                <div class="p-4 bg-success radius1 font-style1">Completed</div>
                <div class="p-4 bg-danger radius1 font-style1">Cancelled</div>
            </div>
            <div class="accordion py-5">
                <?php foreach($orders as $order): ?>
                    <?php 
                    $query = "SELECT seller_id FROM order_products WHERE order_id = ?";
                    $stmt = $cn->prepare($query);
                    $order_id = $order['order_id'];
                    $stmt->bind_param('i', $order_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $seller_id = $result->fetch_assoc();
                   
                   if($_SESSION['user_details']['users_id'] == $seller_id['seller_id']):?>
                        
                  <div class="accordion-item">
                      <h2 class="accordion-header">
                          <button
                            class="accordion-button text-white"
                            data-status-id="<?php echo $order['status_id']?>"
                            data-toggle="collapse"
                            data-target="#order-<?php echo $order['order_id'] ?>">
                            <?php echo $order["transaction_code"]; ?>
                        <?php
                            $users_query = "SELECT * FROM users WHERE users_id = ?";
                            $user_stmt = $cn->prepare($users_query);
                            $user_stmt->bind_param('i', $order['users_id']);
                            $user_stmt->execute();
                            $users_result = $user_stmt->get_result();
                            $user = $users_result->fetch_assoc();
                        ?>
                            <span class="btn disabled"><?php echo $user['name'];?>'s Order</span>
                                    
                          </button>
                      </h2>

                      <div id="order-<?php echo $order['order_id'] ?>" class="accordion-collapse collapse show">
          						<div class="accordion-body">
          							<table class="table">
          								<thead>
          									<tr>
          										<th>User</th>
          										<!-- <th>Payment</th> -->
          										<th>Total</th>
          										<th>Purchased Date</th>
          										<?php if($order["status_id"] == 1): ?>
          										<th>Actions</th>
          										<?php endif; ?>
          									</tr>
          								</thead>
          								<tbody>
          									<tr>
          										<td><?php echo $order["users_id"] ?></td>
          										<!-- <td><?php //echo $order["payment_id"] ?></td> -->
          										<td><?php echo $order["total"] ?></td>
          										<td><?php echo $order["purchase_date"] ?></td>
          										<?php if($order["status_id"] == 1): ?>
          										<td>
          											<a href="/controllers/orders/complete_order.php?order_id=<?php echo $order['order_id']?>" class="btn btn-success">Complete</a>
          											<a href="/controllers/orders/cancel_order.php?order_id=<?php echo $order['order_id']?>" class="btn btn-danger">Cancel</a>
          										</td>
          										<?php endif; ?>
          									</tr>
          								</tbody>
          							</table>
          						</div>
          					</div>
                  </div>
                  <?php endif;?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let accordionBtns = document.querySelectorAll(".accordion-button");
    accordionBtns.forEach(btn => {
        let status_id = btn.getAttribute('data-status-id')
        if(status_id == 1){
            btn.classList.add("bg-info")
        } else if(status_id == 2){ // 2 danger
            btn.classList.add("bg-danger")
        } else{
            btn.classList.add("bg-success") // success
        }
    })
</script>


<?php 
    require_once '../partials/footer.php';
    }
    require_once '../partials/layout.php';
?>