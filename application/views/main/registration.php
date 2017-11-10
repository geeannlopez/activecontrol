        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>New account / Sign in</h1>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="index.html">Home</a>
                            </li>
                            <li>New account / Sign in</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">

                
                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <h2 class="text-uppercase">New account</h2>
                            
                            <?php  
                            echo    $this->session->flashdata('message');
                            ?>
                            
                            <p class="lead">Not our registered customer yet?</p>

                            <hr>

                            <form action="<?=base_url()?>main/register" method="post">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
                                    <?php echo form_error('name', '<font color="red">', '</font>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email1" value="<?php echo set_value('email'); ?>">
                                    <?php echo form_error('email1',  value="<?php echo set_value('birthday'); ?>"'<font color="red">', '</font>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Date of Birth</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo set_value('birthday'); ?>">
                                     <?php echo form_error('birthday', '<font color="red">', '</font>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo set_value('contact'); ?>">
                                       <?php echo form_error('contact', '<font color="red">', '</font>'); ?> 
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo set_value('address'); ?>">
                                        <?php echo form_error('address', '<font color="red">', '</font>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password1">
                                        <?php echo form_error('password1', '<font color="red">', '</font>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="cpassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword">
                                       <?php echo form_error('cpassword', '<font color="red">', '</font>'); ?> 
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i> Register</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box">
                            <h2 class="text-uppercase">Login</h2>

                            <p class="lead">Already our customer?</p>

                            <hr>
    <?php echo form_error('password', '<font color="red">', '</font>'); ?>
                            <form action="<?=base_url()?>main/login_registration" method="post">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-sign-in"></i> Log in</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>