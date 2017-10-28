<div id="content">
            <div class="container">


                <div class="row">

                    <!-- *** LEFT COLUMN ***
             _________________________________________________________ -->
                <div class="col-md-2"></div>
                    <div class="col-md-8" id="customer-orders">

                        <p class="text-muted lead">If you have any questions, please feel free to <a href="contact.html">contact us</a>.</p>

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