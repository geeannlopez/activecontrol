<script>
function clear_cart() {
    var result = confirm('Are you sure want to clear all bookings?');
    
    if(result) {
        window.location = "<?php echo base_url(); ?>main/remove/all";
    }else{
        return false; // cancel button
    }
}
</script>


<div id="content">
            <div class="container">

                <div class="row">

                    <!-- *** LEFT COLUMN ***
      _________________________________________________________ -->

                    <div class="col-sm-2">

                        <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                        <div class="panel panel-default sidebar-menu">

                            <div class="panel-heading">
                                <h3 class="panel-title">Categories</h3>
                            </div>

                            <div class="panel-body">
                                <ul class="nav nav-pills nav-stacked category-menu">
                                  <?php foreach ($category as $i) { ?>
                                    <li>
                                        <a href="<?=base_url()?>main/products/<?=$i->category_id?>"><?= $i->category_name ?></a>
                                    </li>     
                                <?php } ?>

                                </ul>
                            </div>
                        </div>
                        <!-- *** MENUS AND FILTERS END *** -->

                    </div>
                    <!-- /.col-md-2 -->

                    <!-- *** LEFT COLUMN END *** -->

                    <!-- *** MIDDLE COLUMN *** -->

                    <div class="col-sm-6">

                        <div class="row products">


                          <?php foreach ($products as $i) {

                            $id = $i->prod_id;
                            $name = $i->prod_name;
                            $price = $i->prod_price;
                            $stock = $i->qty_received-$i->qty_delivered;

                           ?>
                            <div class="row">
                              <div class="col-md-12 col-sm-12">
                                <div class="product">
                                  <div class="col-md-3 col-sm-3">
                                    <div class="image">
                                            <img src="<?=base_url()?>images/<?=$i->prod_image?>" alt="" class="img-responsive image1">
                                    </div>
                                  </div>

                                    <!-- /.image -->
                                  <div class="col-md-6 col-sm-6">
                                    <div class="text"><font style="text-align: left">
                                        <h3><?= $i->prod_name ?></h3>
                                        <p><?= nl2br($i->prod_desc) ?></p>
                                        <p class="price">₱<?= $i->prod_price ?></p>
                                     </font></div>
                                    </div>
                                    <!-- /.text -->
                                  <div class="col-md-3 col-sm-3">

                                    <?php if ($stock > 0) {
                                    
                                    echo form_open('Main/add');
                                    echo form_hidden('id', $id);
                                    echo form_hidden('name', $name);
                                    echo form_hidden('price', $price);
                                    echo form_submit('action', 'Add to Cart', 'class="btn btn-template-main"');
                                    echo form_close();

                                    }else{ ?>
                                    <button class="btn btn-template-main" disabled="">Add to Cart</button>
                                    <?php }
                                    ?>
                                    <p class="text"><?= "Available: ".$stock ?></p>
                                  </div>
                                </div>
                                <!-- /.product -->
                            </div>           
                          </div>


                          <?php } ?>
   

                        </div>
                        <!-- /.products -->



<!--                         <div class="pages">


                            <ul class="pagination">
                                <li><a href="#">«</a>
                                </li>
                                <li class="active"><a href="#">1</a>
                                </li>
                                <li><a href="#">2</a>
                                </li>
                                <li><a href="#">3</a>
                                </li>
                                <li><a href="#">4</a>
                                </li>
                                <li><a href="#">5</a>
                                </li>
                                <li><a href="#">»</a>
                                </li>
                            </ul>
                        </div> -->


                    </div>
                    <!-- /.col-md-6 -->

                    <!-- *** MIDDLE COLUMN END *** -->

                    <!-- *** RIGHT COLUMN *** -->


                    <div class="col-md-4 the_cart">
                        <h3>CART</h3>
                        <table border="0" align="center" cellpadding="5px" cellspacing="1px">
                            <?php if ($cart = $this->cart->contents()): ?>
                            <tr style="font-weight:bold">
                                <!-- <td>Item</td> -->
                                <td>Name</td>
                                <td>Price</td>
                                <td>Qty</td>
                                <td>Amount</td>
                                <td>Options</td>
                            </tr>
                            <?php
                            echo form_open('main/update_cart');
                            $grand_total = 0; $i = 1;
                            
                            foreach ($cart as $item):
                                echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
                                echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
                                echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
                                echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
                                echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
                            ?>
                            <tr>
                                <!-- <td>
                                    <?php echo $i++; ?>
                                </td> -->
                                <td>
                                    <?php echo $item['name']; ?>
                                </td>
                                <td>
                                    ₱ <?php echo number_format($item['price'],2); ?>
                                </td>
                                <td>
                                
                                <?php
                                    $data = array(
                                        'type'  => 'number',
                                        'name'  => 'cart['. $item['id'] .'][qty]',
                                        'value' => $item["qty"],
                                        'size'  => '1',
                                        'min'   => '1',
                                        'style' => 'width: 50px;'
                                    );

                                    echo form_input($data); ?> 
                                </td>
                                <?php $grand_total = $grand_total + $item['subtotal']; ?>
                                <td>
                                    ₱ <?php echo number_format($item['subtotal'],2) ?>
                                </td>
                                <td>
                                    <?php echo anchor('main/remove/'.$item['rowid'],'Remove'); ?>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td colspan="5" align="left">
                                    <br>
                                    <b>Order Total: ₱<?php echo number_format($grand_total,2); ?></b>
                                </td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="5" align="center">
                                    <br>
                                    <input type="button" value="Clear Cart" onclick="clear_cart()">
                                    <input type="submit" value="Update Cart">
                                    <?php echo form_close(); ?>
                                    
                                    <?php if($this->user->info('user_id')){ ?>
                                    <a href="<?=base_url()?>main/checkout_shipping" style="color: black">
                                    <input type="button" value="Place Order"></a>
                                    <?php }else{ ?>

                                    <input type="button" title="Please Login to place and order" value="Place Order" disabled="">

                                    <?php } ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>

                    <!-- *** RIGHT COLUMN END *** -->

                </div>

            </div>
            <!-- /.container -->
        </div>