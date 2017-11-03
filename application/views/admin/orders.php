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
    var status = $(this).data('status');
       $(".id").val(id);
       $(".status").val(status);
    });

       $('#example1').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
   });  
</script>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order List
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
                  <th>Order #</th>
                  <th>Order By:</th>
                  <th>Date Ordered</th>
                  <th>Last Update</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th> </th>
                </tr>
                </thead>
                <tbody>


                <?php foreach ($orders as $i) { ?>
                <tr>  
                  <td><?=$i->order_id?></td>
                  <td><?=$i->user_name?></td>
                  <td><?= $i->order_date?></td>
                  <td><?= $i->date_updated?></td>
                  <td><?= $i->order_amount?></td>
                  <td>
                    <?php if($i->status=="processing"){ ?>
                       <span class="label label-info">Processing</span>
                       <?php }else if($i->status=="delivery"){?>
                      <span class="label label-warning">Ready to deliver</span>
                     <?php }else{ ?>
                      <span class="label label-success">Received</span>
                      <?php } ?>
                      </td>
                      <td>
                <button class="btn btn btn-xs edit"  data-toggle="modal" data-target="#edit"  data-id="<?= $i->order_id ?>" data-status="<?= $i->status ?>">Change Status</button>
                <button class="btn btn btn-xs"><a href="<?= base_url()?>admin/view_order/<?=$i->order_id?>">View Order</a></button></td>
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
        <h4 class="modal-title">Update Status</h4>
      </div>
      <div class="modal-body">
        <form role="form" action="<?= base_url()?>Admin/update_order"  method="post" enctype="multipart/form-data">
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
                  <input type="hidden" class="id" name="id">
                <div class="form-group">
                  <label for="name">
                   Status:
                  </label>
                  <select class="status form-control" name="status">
                    <option value="processing">processing</option>
                    <option value="delivery">delivery</option>
                    <option value="received">received</option>
                  </select>
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