<style>
img{
  width: auto;
  max-width: 100px;
  height: auto;
  max-height: 100px;
}
</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staff
                <a href="<?= base_url()?>admin/add_staff"><button class="pull-right btn btn-success add" type="button" >+</button></a>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Customer name</th>
                  <th>Date of Birth</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Contact Number</th>
                  <th>Registered Date</th>
                  <th>Status</th>
                  <th> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($staff as $i) { ?>
                <tr>
                  <td><?= $i->user_name?></td>
                  <td><?= $i->user_bday?></td>
                  <td><?= $i->user_email?></td>
                  <td><?= $i->user_address?></td>
                  <td><?= $i->user_contactno?></td>
                  <td><?= $i->date_created?></td>
                  <td><?php if ($i->user_status == 1){
                      echo "<span class='label label-success'>Active</span>";
                    }else{
                      echo "<span class='label label-danger'>Deactivated</span>";
                      }?>         
                  </td>
                  <td>
                    <?php if ($i->user_status == 1){ ?>
                    <a href="<?= base_url()?>Admin/deactivate_user/<?=$i->user_id?>/deactivate">
                    <button class="btn btn btn-xs pull-right edit">Deactivate</button></a>
                    <?php }else{ ?>
                    <a href="<?= base_url()?>Admin/deactivate_user/<?=$i->user_id?>/activate">
                    <button class="btn btn btn-xs pull-right edit">Activate</button></a>

                 <?php  } ?>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->