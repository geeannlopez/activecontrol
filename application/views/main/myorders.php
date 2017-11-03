<div id="content">
            <div class="container">


                <div class="row" style="min-height: 550px;">

                    <!-- *** LEFT COLUMN ***
             _________________________________________________________ -->
                <div class="col-md-2"></div>
                    <div class="col-md-8" id="customer-orders">

                        <?php if( !empty($orders) ){  ?>
                        <p class="text-muted lead">Your orders.</p>
                        

                        <div class="box">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php   
                                            foreach ($orders as $i){ ?>  
                                        <tr>
                                            <th># <?= $i->order_id ?></th>
                                            <td><?= $i->order_date ?></td>
                                            <td>₱ <?= $i->order_amount ?></td>
                                            <td>
                                                <?php if($i->status=="processing"){ ?>
                                            <span class="label label-info">Processing</span>
                                            <?php }else if($i->status=="delivery"){?>
                                            <span class="label label-warning">Ready to deliver</span>
                                            <?php }else{ ?>
                                            <span class="label label-success">Received</span>
                                            <?php } ?>
                                            </td>
                                            <td><a href="<?= base_url()?>customer/view_order/<?=$i->order_id?>" class="btn btn-template-main btn-sm">View</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.box -->
                        <?php } elseif(true){ ?>
                            <br><br><br><br><br><br><br>
                            <p class="text-muted lead">You have no orders yet. <a href="<?=base_url()?>main/products">Shop now!</a> </p>                            
                        <?php } ?> 
                    </div>
                    <!-- /.col-md-9 -->

                    <!-- *** LEFT COLUMN END *** -->

                    <!-- *** RIGHT COLUMN ***
             _________________________________________________________ -->

                

                    <!-- *** RIGHT COLUMN END *** -->

                </div>


            </div>
            <!-- /.container -->
        </div>