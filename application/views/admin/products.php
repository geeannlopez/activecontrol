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
        Product List
                <a href="<?= base_url()?>admin/add_product"><button class="pull-right btn btn-success add" type="button" >+</button></a>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Description</th>
                  <th width="40px">Price</th>
                  <th>Category</th>
                  <th>Date created</th>
                  <th>Last updated</th>
                  <th>Status</th>
                  <th> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $i) { ?>
                <tr>
                  <td><center><img src="<?php echo base_url("images/$i->prod_image"); ?>" ></center></td>
                  <td><?=$i->prod_name?></td>
                  <td><?= nl2br($i->prod_desc)?></td>
                  <td>₱<?= $i->prod_price?></td>
                  <td><?= $i->category_name?></td>
                  <td><?= $i->created_date?></td>
                  <td><?= $i->last_updated?>
                  <td><?php if ($i->status == 1){
                      echo "enabled";
                    }else{
                      echo "disabled";
                      }?>         
                  </td>
                  <td>
                <button class="btn btn btn-xs pull-right edit" data-id="<?= $i->category_id ?>" data-name="<?= $i->category_name ?>">EDIT</button></td>
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