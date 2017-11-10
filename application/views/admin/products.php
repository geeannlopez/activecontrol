<style>
img{
  width: auto;
  max-width: 100px;
  height: auto;
  max-height: 100px;
}
</style>
<script>
$(document).ready(function(){
   $(".edit").click(function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var price = $(this).data('price');
    var desc = $(this).data('desc');
    var crit = $(this).data('crit');
       $(".id").val(id);
       $(".name").val(name);
       $(".price").val(price);
       $(".desc").val(desc);
       $(".critical_level").val(crit);

    });

       $('#example1').DataTable( {
        "order": [[ 5, "desc" ]]
    } );
   });  
</script>


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

             <!-- message -->
                            <?php if(validation_errors()){ ?>
                            <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">×<span class="sr-only"> </span></button>
                            <?php echo validation_errors(); ?>
                            </div>
                            <?php } 
                            echo    $this->session->flashdata('message');
                            ?>
                            
                            <!-- endmessage -->
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
                       echo "<span class='label label-success'>Active</span>";
                    }else{
                      echo "<span class='label label-danger'>Inactive</span>";
                      }?>           
                  </td>
                  <td>
                  <?php if ($i->status == 1){ ?>
                    <a href="<?= base_url()?>Admin/deactivate_prod/<?=$i->prod_id?>/deactivate">
                    <button class="btn btn btn-xs">Deactivate</button></a>
                    <?php }else{ ?>
                    <a href="<?= base_url()?>Admin/deactivate_prod/<?=$i->prod_id?>/activate">
                    <button class="btn btn btn-xs">Activate</button></a>

                 <?php  } ?> 
                <button class="btn btn btn-xs pull-right edit"  data-toggle="modal" data-target="#edit"  data-id="<?= $i->prod_id ?>" data-name="<?= $i->prod_name ?>" data-desc="<?= $i->prod_desc ?>" data-price="<?= $i->prod_price ?>" data-category="<?= $i->prod_category ?>" data-crit="<?= $i->critical_level ?>">EDIT</button></td>
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

  <iv id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <form role="form" action="<?= base_url()?>Admin/edit_product"  method="post" enctype="multipart/form-data">
              <div class="box-body">
                   <!--               <div class="form-group">
                  <label for="name">
                    Product Category:
                  </label>
                  <select name="category" class="form-control">
                  <?php foreach ($category as $i) { ?>
                    <option value="<?php echo $i->category_id ?>" class="category" <?php echo  set_select('category', $i->category_id ); ?>><?= $i->category_name ?></option>
                  <?php } ?>
                  </select>-->
                </div>
                  <input type="hidden" name="action" value="edit">
                  <input type="hidden" class="id" name="id">
                <div class="form-group">
                  <label for="name">
                    Product Name:
                  </label>
                  <input type="text" name="name" class="form-control name" value="<?= set_value('name'); ?>" placeholder="Product Name">
                </div>
                <div class="form-group">
                  <label for="Price">
                    Price:
                  </label>
                  <input type="number" name="price" min="1" step="any" class="form-control price" value="<?= set_value('price'); ?>" placeholder="Price">
                </div>
                <div class="form-group">
                  <label for="Desc">
                    Description:
                  </label> 
                <textarea name="description" class="form-control desc" rows="4" cols="50"><?= set_value('description'); ?></textarea>
                </div>
                <div class="form-group">
                  <label for="Price">
                    Critical Level:
                  </label>
                  <input type="number" name="critical_level" min="1" class="form-control critical_level" value="<?= set_value('critical_level'); ?>" placeholder="Price">
                </div>                
                <div class="form-group">
                  <label for="Unit">
                    Image:
                  </label> 
                <input type="file" name="image"/>
                </div>
                
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
              </div>
            </form>
        </div>
    </div>

  </div>
</div>