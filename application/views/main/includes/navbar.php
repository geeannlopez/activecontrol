

            <!-- *** TOP END *** -->

            <!-- *** NAVBAR ***
_________________________________________________________ -->

            <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

                <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                    <div class="container">
                        <div class="navbar-header">

                            <a class="navbar-brand home" href="<?=base_url() ?>main">
                                <img src="<?=base_url()?>/assets/img/logo-aces.png" alt="Universal logo" class="hidden-xs hidden-sm">
                                <img src="<?=base_url()?>/assets/img/logo-aces-small.png" alt="Universal logo" class="visible-xs visible-sm">
                            </a>
                            <div class="navbar-buttons">
                                <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-align-justify"></i>
                                </button>
                            </div>
                        </div>
                        <!--/.navbar-header -->

                        <div class="navbar-collapse collapse" id="navigation">

                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="<?=base_url()?>" class="dropdown-toggle">ABOUT</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?=base_url()?>main/products" class="dropdown-toggle">PRODUCTS</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?=base_url()?>#principals" class="dropdown-toggle">OUR PRINCIPALS</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?=base_url()?>" class="dropdown-toggle">CONTACT</a>
                                </li>

                            </ul>
                                                    
                        </div>
                        <!--/.nav-collapse -->




                        <div class="collapse clearfix" id="search">

                            <form class="navbar-form" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">

                                        <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button>

                                    </span>
                                </div>
                            </form>

                        </div>
                        <!--/.nav-collapse -->

                    </div>


                </div>
                <!-- /#navbar -->

            </div>

            <!-- *** NAVBAR END *** -->

        </header>


        <!-- *** LOGIN MODAL ***
_________________________________________________________ -->

        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title" id="Login">Customer login</h4>
        <?php echo form_error('password', '<font color="red">', '</font>'); ?>
                    </div>
                    <div class="modal-body">
                        <form action="<?=base_url()?>main/verify_login" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email_modal" placeholder="email" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password_modal" placeholder="password" name="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-template-main"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="customer-register.html"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

        <!-- *** LOGIN MODAL END *** -->