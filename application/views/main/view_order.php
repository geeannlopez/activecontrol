
        <div id="content">
            <div class="container">

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 clearfix" id="checkout">

                        <div class="box">
                           


                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-10">
                                                <b><?= $this->user->info('user_name') ?></b><br>
                                                 <?= $this->user->info('user_address') ?><br>
                                                    Mobile Number: <?= $this->user->info('user_contactno') ?><br>
                                                    Email Address: <?= $this->user->info('user_email') ?>     

                                        </div>
                                    </div>
                                        <br>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">Product</th>
                                                    <th>Quantity</th>
                                                    <th>Unit price</th>
               
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
    
                                                </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>

                                    </div><br>


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

                                <div class="box-footer">
                                    <div class="pull-left">
                                        <a href="<?=base_url()?>customer/orders" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to My Orders</a>
                                    </div><!-- <div class="pull-right">
                                        <a href="<?= base_url()?>main/payment"><button class="btn btn-template-main">Continue to Payment<i class="fa fa-chevron-right"></i>
                                        </button>
                                    </div> -->                         </div>
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col-md-9 -->

                

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>