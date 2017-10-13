<script>
$(document).ready(function(){
   $(".add").click(function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
       $(".id").val(id);
       $(".name").val(name);
});
   });
</script>
 

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory Stock
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
              <table id="example1" class="table table-bordered table-striped" width="50%">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Remaining Stocks</th>
                  <th> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $i) { ?>
                <tr>
                  <td><?=$i->prod_name?></td>
                  <td><?= $i->qty_received-$i->qty_delivered ?></td>
                  <td>
                <button type="button" class="btn btn-default btn-xs add" data-toggle="modal" data-target="#add" data-id="<?=$i->prod_id?>" data-name="<?=$i->prod_name?>">Add</button>&nbsp;<button class="btn btn btn-xs">View</button></td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->


<!-- Add Modal -->
<div id="add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Stock</h4>
      </div>
      <div class="modal-body">
        <form role="form" action="<?= base_url()?>admin/add_stock"  method="post">
              <div class="box-body">
                <input type="hidden" name="id" class="form-control id" readonly="">
                <div class="form-group">
                  <label for="name">
                    Product Name:
                  </label>
                  <input type="text" name="name" class="form-control name" readonly="">
                </div>
                <div class="form-group">
                  <label for="invoiceno">
                    Invoice:
                  </label>
                  <input type="text" name="invoiceno" class="form-control invoiceno" placeholder="Invoice">
                </div>
                <div class="form-group">
                  <label for="invoicedate">
                    Invoice Date:
                  </label> 
                <input type="Date" name="invoicedate" class="form-control invoicedate">
                </div>
                <div class="form-group">
                  <label for="qty">
                    Qty:
                  </label> 
                  <input type="number" name="qty_received" class="form-control qty" placeholder="Qty" min="1">
                </div>
                <div class="form-group">
                  <label for="price">
                    Price/pc:
                  </label> 
                  <input type="number" step=".01" name="price" class="form-control price" placeholder="Price" min="1">
                </div>
                
              <!-- /.box-body -->

        
      </div>
      <div class="modal-footer">
                <button type="submit" class="btn btn-success pull-right">Add</button>
              </div>
      </div>
          </form>
    </div>

  </div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

