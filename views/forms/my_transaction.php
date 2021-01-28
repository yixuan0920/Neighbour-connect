<?php
    session_start();
    $title = "My Transactions";
    // if(!isset($_SESSION["user_details"]) && !$_SESSION["user_details"]["isAdmin"]){
    //     header("Location: /");
    // }
    function get_content(){
        require_once '../../controllers/connection.php';
        require_once '../partials/nav.php';
        $user_id = $_SESSION["user_details"]["users_id"];
        $query = "SELECT * FROM orders WHERE users_id = ?";
        $stmt = $cn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = $result->fetch_all(MYSQLI_ASSOC);
?>
<div class="color1">
<p>.</p>
<div class="container">
    <div class="row">
        <h2 class="mt-5 text-center"> My Transactions </h2>
        <hr>
        <div class="col-md-8 mx-auto">
            <div class="text-white d-flex pt-5 justify-content-between">
                <div class="p-4 bg-info radius1">Pending</div>
                <div class="p-4 bg-success radius1">Completed</div>
                <div class="p-4 bg-danger radius1">Cancelled</div>
            </div>
            <div class="accordion py-5">
                <?php foreach($orders as $order): ?>
                  <div class="accordion-item">
                      <h2 class="accordion-header">
                          <button
                            class="accordion-button text-white"
                            data-status-id="<?php echo $order['status_id']?>"
                            data-toggle="collapse"
                            data-target="#order-<?php echo $order['order_id'] ?>">
                            <?php echo $order["transaction_code"]; ?>
                          </button>
                      </h2>

                      <div id="order-<?php echo $order['order_id'] ?>" class="accordion-collapse collapse show">
          						<div class="accordion-body">
          					    <p>Purchase Date <?php echo $order['purchase_date']?></p>
          						        <small>Mode of Payment: 
                                            <strong>
                                                Online
                                            </strong>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                              <?php
                                $op_query =
                                "SELECT * FROM order_products op
                                 JOIN products p ON(op.products_id = p.products_id)
                                 WHERE op.order_id =" .$order['order_id'];
                                $ops = $cn->query($op_query);
                                foreach($ops as $op):
                                    $subtotal = $op['price'] * $op['quantity']
                              ?>
                              <tr>
                                  <td><?php echo $op['name'] ?></td>
                                  <td><?php echo $op['price'] ?></td>
                                  <td><?php echo $op['quantity'] ?></td>
                                  <td><?php echo number_format($subtotal, 2) ?></td>
                              </tr>

                            <?php endforeach; ?>
                        </table>

                        <div class="d-flex justify-content-between">
								<?php if ($order['status_id'] == 1): ?>
									<a href="/controllers/orders/cancel_order.php?order_id=<?php echo $order['order_id']?>" class="btn btn-danger">Cancel Order</a>
								<?php endif ?>
								<h2>Total: <strong>RM <?php echo $order['total'] ?></strong></h2>
							</div>


						</div>
					</div>
				</div>			
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

