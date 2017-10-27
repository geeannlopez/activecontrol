<?php $cart = $this->cart->contents(); ?>
<div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>Checkout - Order Review</h1>
                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">

                <div class="row">

                    <div class="col-md-9 clearfix" id="checkout">

                        <div class="box">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                    </li>
                                </ul>


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
                                                    <th colspan="2">Product</th>
                                                    <th>Quantity</th>
                                                    <th>Unit price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php                       $grand_total = 0; $i = 1;
                                            foreach ($cart as $item){ ?>     
                                                <tr>
                                                    <td><?= $i++ ?></td>
            <td>
                <?php echo $item['name']; ?>
            </td>
            <td>
                <?php echo $item['qty']; ?>
            </td>
            <td>
                ₱ <?php echo number_format($item['price'],2); ?>
            </td>            
            <?php $grand_total = $grand_total + $item['subtotal']; ?>
            <td>
                ₱    <?php echo number_format($item['subtotal'],2) ?>
            </td>

                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">Total</th>
                                                    <th>₱<?= number_format($this->cart->total(), 2); ?></th>
                                                </tr>
                                            </tfoot>
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
                                        <a href="<?=base_url()?>main/shoppingcart" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
                                    </div><!-- <div class="pull-right">
                                        <a href="<?= base_url()?>main/payment"><button class="btn btn-template-main">Continue to Payment<i class="fa fa-chevron-right"></i>
                                        </button>
                                    </div> -->                              <div class="pull-right" id="paypal-button-container"></div>                        </div>
                        </div>
                        <!-- /.box -->


    <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AZz_iX6DRWnebjPbDO3wgTe2i-Tvbp1OLdSR6-Ia2B7iLS4peKNFo7qAx9u56mvuoZAW-Jrp84NJXIdG',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '100', currency: 'PHP' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                });
            }

        }, '#paypal-button-container');

    </script>

                    </div>
                    <!-- /.col-md-9 -->

                    <div class="col-md-3">

                        <div class="box" id="order-summary">
                            <div class="box-header">
                                <h3>Order summary</h3>
                            </div>
                            <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Order subtotal</td>
                                            <th>$446.00</th>
                                        </tr>
                                        <tr>
                                            <td>Shipping and handling</td>
                                            <th>$10.00</th>
                                        </tr>
                                        <tr>
                                            <td>Tax</td>
                                            <th>$0.00</th>
                                        </tr>
                                        <tr class="total">
                                            <td>Total</td>
                                            <th>$456.00</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>