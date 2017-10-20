<div id="content">
            <div class="container">

                <div class="row">


                    <!-- *** LEFT COLUMN ***
      _________________________________________________________ -->

                    <div class="col-sm-3">

                        <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                        <div class="panel panel-default sidebar-menu">

                            <div class="panel-heading">
                                <h3 class="panel-title">Categories</h3>
                            </div>

                            <div class="panel-body">
                                <ul class="nav nav-pills nav-stacked category-menu">
                                    <li>
                                        <a href="<?=base_url()?>main/products">All</a>
                                    </li> 
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
                    <!-- /.col-md-3 -->

                    <!-- *** LEFT COLUMN END *** -->

                    <!-- *** RIGHT COLUMN ***
      _________________________________________________________ -->

                    <div class="col-sm-9">

                        <div class="row products">


                          <?php foreach ($products as $i) { ?>
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
                                    <div class="text"><font style="text-align: left;">
                                        <h3><?= $i->prod_name ?></h3>
                                        <p><?= nl2br($i->prod_desc) ?></p>
                                        <p class="price">P<?= $i->prod_price ?></p>
                                     </font></div>
                                    </div>
                                    <!-- /.text -->
                                  <div class="col-md-3 col-sm-3">
                                        <p class="buttons">
                                            <a href="shop-detail.html" class="btn btn-default">View detail</a>
                                            <a href="shop-basket.html" class="btn btn-template-main"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </p>
                                  </div>
                                </div>
                                <!-- /.product -->
                            </div>           
                          </div>


                          <?php } ?>
   

                        </div>
                        <!-- /.products -->



                        <div class="pages">


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
                        </div>


                    </div>
                    <!-- /.col-md-9 -->

                    <!-- *** RIGHT COLUMN END *** -->

                </div>

            </div>
            <!-- /.container -->
        </div>