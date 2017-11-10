<script>
$(document).ready(function(){
    $("#add_category").hide();  
    $(".add").click(function(){
        $("#add_category").toggle();
        $("#edit_category").hide(); 
    });
    $("#edit_category").hide();  
    $(".edit").click(function(){
        $("#edit_category").show();
        $("#add_category").hide();  

    var id = $(this).data('id');
    var name = $(this).data('name');
    var brand = $(this).data('brand');
       $(".id").val(id);
       $(".brand").val(brand);
       $(".name").val(name);
    });

});
</script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products Category
                <button class="pull-right btn btn-success add" type="button" >
      +
    </button>
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

       <div id="add_category" style="width: 50%; margin: 0 auto">
            <!-- /.box-header -->
              <form role="form" action="<?= base_url()?>admin/a_category"  method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Brand Name</label>
                  <input type="text" name="brand" class="form-control" placeholder="Brand" value="<?= set_value('brand'); ?>">
                  <label for="name">Category Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Category" value="<?= set_value('name'); ?>">

                  <input type="hidden" name="action" class="form-control" value="add" placeholder="">
                </div>
                <button type="submit" class="btn btn-success pull-right btn-sm">Add</button>
              </div>
              <!-- /.box-body -->
            </form>
                  <hr>
            </div>

        <div id="edit_category" style="width: 50%; margin: 0 auto">
            <!-- /.box-header -->
              <form role="form" action="<?= base_url()?>admin/a_category"  method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">ID</label>
                  <input type="text" name="id" class="form-control id" placeholder="Category" readonly>
                  <label for="name">Category Brand</label>
                  <input type="text" name="brand" class="form-control brand" placeholder="brand">
                  <label for="name">Category Name</label>
                  <input type="text" name="name" class="form-control name" placeholder="Category">
                  <input type="hidden" name="action" class="form-control" value="update" placeholder="">
                </div>
                <button type="submit" class="btn btn-success pull-right btn-sm">Update</button>
              </div>
              <!-- /.box-body -->
            </form>
                  <hr>
            </div> 

            <!-- /.box-header -->
            <div class="box-body" style="width: 50%; margin: 0 auto">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Brand</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($category as $i) { ?>
                <tr>
                  <td><?= $i->category_brand; ?></td>
                  <td><?= $i->category_name; ?></td>
                  <td><?php if ($i->status == 1){
                      echo "<span class='label label-success'>Active</span>";
                    }else{
                      echo "<span class='label label-danger'>Inactive</span>";
                      }?>         
                  </td>
                  <td><!-- <?php if ($i->status == 1){
                      echo "enabled";
                    }else{
                      echo "disabled";
                      }?> -->
                  <button class="btn btn btn-xs edit" data-id="<?= $i->category_id ?>" data-name="<?= $i->category_name ?>" data-brand="<?= $i->category_brand ?>" >EDIT</button>
                                  <?php if ($i->status == 1){ ?>
                    <a href="<?= base_url()?>Admin/deactivate_cat/<?=$i->category_id?>/deactivate">
                    <button class="btn btn btn-xs">Deactivate</button></a>
                    <?php }else{ ?>
                    <a href="<?= base_url()?>Admin/deactivate_cat/<?=$i->category_id?>/activate">
                    <button class="btn btn btn-xs">Activate</button></a>

                 <?php  } ?> </td>
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


  