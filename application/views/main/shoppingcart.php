<script>
function clear_cart() {
    var result = confirm('Are you sure want to clear all bookings?');
    
    if(result) {
        window.location = "<?php echo base_url(); ?>main/remove_s/all";
    }else{
        return false; // cancel button
    }
}
</script>

<?php $cart = $this->cart->contents(); ?>

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Shopping cart</h1>
                    </div>
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url() ?>Main/products">Products</a>
                            </li>
                            <li>Shopping cart</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <p class="text-muted lead">You currently have <?= count($cart)?> item(s) in your cart.</p>
                    </div>


                    <div class="col-md-9 clearfix" id="basket">

                        <div class="box">


                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2" width="300">Product</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                                <th colspan="2">Total</th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              echo form_open('Main/update_cart_s');
                                                $grand_total = 0; $i = 1;
        
                                                foreach ($cart as $item){
                                                    echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
                                                    echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
                                                    echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
                                                    echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
                                                    echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
                                                ?>
                                      <tr>
            <td><?= $i++ ?></td>
            <td>
                <?php echo $item['name']; ?>
            </td>
            <td>
              <?php
                $data = array(
                    'type'  => 'number',
                    'name'  => 'cart['. $item['id'] .'][qty]',
                    'value' => $item["qty"],
                    'size'  => '1',
                    'min'   => '1',
                    'style' => 'width: 50px;',
                    'class' => 'form-control',
                    'maxlength' => '3'
                   );

                 echo form_input($data); ?> 

            </td>
            <td>
                ₱ <?php echo number_format($item['price'],2); ?>
            </td>            
            <?php $grand_total = $grand_total + $item['subtotal']; ?>
            <td>
                ₱    <?php echo number_format($item['subtotal'],2) ?>
            </td>
            <td>
                <?php echo anchor('Main/remove_s/'.$item['rowid'],'<i class="fa fa-trash-o"></i>'); ?>
            </td>
            <?php } ?>
        </tr>

        <!-- <tr>
            <td><b>Order Total: ₱<?php echo number_format($grand_total,2); ?></b></td>
            <td colspan="5" align="right"><input type="button" value="Clear Cart" onclick="clear_cart()">
                    <input type="submit" value="Update Cart">
                    <?php echo form_close(); ?>
                    <a href="<?= base_url() ?>main/shoppingcart">
                    <input type="button" value="Place Order"></td>
        </tr>
         -->                                    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total</th>
                                                <th colspan="2">₱<?php echo number_format($grand_total,2); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- /.table-responsive -->

                                <div class="box-footer">
                                    <div class="pull-left">
                                        <a href="<?= base_url() ?>main/products" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" value="Update Cart" class="btn btn-default"><i class="fa fa-refresh"></i> Update cart</button>
                                        <?php echo form_close(); ?>
                                        <?php if($this->user->info('user_id')){ ?>
                                        <a href="<?=base_url()?>main/checkout_shipping"><button type="submit" class="btn btn-template-main">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                        </button></a>
                                        <?php }else{ ?>
                                        <button type="submit" class="btn btn-template-main" disabled="">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                        </button>

                                        <?php } ?>
                                    </div>
                                </div>

         

                        </div>
                        <!-- /.box -->
                        
                    </div>

                    <!-- /.col-md-9 -->

<?php if($this->user->info('user_id')){ ?>
                    <div class="col-md-3">
                        <div class="box" id="order-summary">
                            <div class="box-header">
                                <h3>Order Summary</h3>
                            </div>
                            <div class="table-responsive">

                            </div>

                        </div>
                    </div>

                    <?php }else{ ?>


                    <div class="col-md-3">
                        <div class="box" id="order-summary">
                            <div class="box-header">
                                <h3>Login</h3>
                            </div>
                            <div>
                          <?php echo form_error('password', '<font color="red">', '</font>'); ?>
              
                                 <form action="<?= base_url() ?>main/login_checkout" method="post">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-sign-in"></i> Log in</button>
                                </div>
                            </form>
                            </div>

                        </div>
                    </div>


                    <?php } ?>
                    <!-- /.col-md-3 -->

                </div>

            </div>
            <!-- /.container -->
        </div>