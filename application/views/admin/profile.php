
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

                            <!-- message -->
                             <?php if(validation_errors()){ ?>
                            <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">×<span class="sr-only"> </span></button>
                            <?php echo validation_errors(); ?>
                            </div>
                            <?php } 
                            echo    $this->session->flashdata('message');
                            ?>
                            
                            
                            <!-- endmessage -->

        <div class="col-md-6">
         <div class="box">
            <!-- form start -->
            <form action="<?=base_url()?>Admin/update_profile" method="post">

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name', $profile[0]->user_name); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email', $profile[0]->user_email); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Date of Birth</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo set_value('birthday', $profile[0]->user_bday); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo set_value('contact', $profile[0]->user_contactno); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo set_value('address', $profile[0]->user_address); ?>">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i>Update</button>
                                </div>
                              </div>
                            </form>
          </div>
        </div>
          <div class="col-md-6">
           <div class="box">
            <!-- form start -->
            <form action="<?=base_url()?>Admin/changepass" method="post">

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="oldpass">Current Password</label>
                                    <input type="password" class="form-control" id="oldpass" name="oldpass">
                                </div>
                                <div class="form-group">
                                    <label for="oldpass">New Password</label>
                                    <input type="password" class="form-control" id="newpass" name="newpass">
                                </div>
                                <div class="form-group">
                                    <label for="oldpass">Confirm Password</label>
                                    <input type="password" class="form-control" id="cnewpass" name="cnewpass">
                                </div>                          
                                <div class="text-center">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-user-md"></i>Update</button>
                                </div>
                              </div>
                            </form>
               </div>    
          </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->