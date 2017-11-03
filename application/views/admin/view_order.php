
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

                            <!-- message -->
                            <div class="content">
                                    <div class="row">
                                        <div class="col-sm-10">
                                                <b>Order ID: <?= $order[0]->order_id ?></b><br>
                                                <b><?= $order[0]->user_name ?></b><br>
                                                 <?= $order[0]->user_address?><br>
                                                    Mobile Number: <?=  $order[0]->user_contactno ?><br>
                                                    Email Address:<?=  $order[0]->user_email ?>     

                                        </div>
                                    </div>
                                        <br>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">Product</th>
                                                    <th>Quantity</th>
                                                    <th>Unit price</th>
                                                    <th>Amount</th>
               
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php  $grand_total = 0; $i = 1;
                                            foreach ($order_line as $item){ ?>     
                                                <tr>
                                                    <td><?= $i++ ?></td>
            <td>
                <?php echo $item->prod_name; ?>
            </td>
            <td>
                <?php echo nl2br($item->prod_desc); ?>
            </td>
            <td>
                <?php echo $item->prod_qty; ?>
            </td>
            <td>
                ₱ <?php echo $item->prod_price;  ?>
            </td> 
            <td>  ₱ <?php echo $item->prod_price*$item->prod_qty;  ?>          
            </td>            
    
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tr>
                                                <td colspan="5"><b>TOTAL:</b></td><td><b>₱ <?= $order[0]->order_amount ?></b></td>
</tr>
                                        </table>

                       <br>


                                    <!-- /.row -->

                                    <!-- <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="company">Company</label>
                                                <input type="text" class="form-control" id="company">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="street">Street</label>
                                                <input type="text" class="form-control" id="street">
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- /.row -->

                                    <!-- <div class="row">
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="zip">ZIP</label>
                                                <input type="text" class="form-control" id="zip">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select class="form-control" id="state"></select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select class="form-control" id="country"></select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="phone">Telephone</label>
                                                <input type="text" class="form-control" id="phone">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email">
                                            </div>
                                        </div>

                                    </div> -->
                                    <!-- /.row -->
                                </div>

                                <div>
                                    <div class="">
                                        <a href="<?=base_url()?>admin/orders" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back to Orders</a>
                                    </div><!-- <div class="pull-right">
                                        <a href="<?= base_url()?>main/payment"><button class="btn btn-template-main">Continue to Payment<i class="fa fa-chevron-right"></i>
                                        </button>
                                    </div> -->                         </div>
                            
                            
                            <!-- endmessage -->

        <div class="col-md-6">
         


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->