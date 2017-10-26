 <?php //echo str_replace('\r\n', "<br>", $products[1]->prod_desc); die();
 //echo nl2br($products[1]->prod_desc); die(); 

 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Product
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

        <div class="box box-success" style="width: 50%; margin:0 auto;">
            <!-- form start -->
            <form role="form" action="<?= base_url()?>admin/a_product"  method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">
                    Product Category:
                  </label>
                  <select name="category" class="form-control">
                  <?php foreach ($category as $i) { ?>
                    <option value="<?php echo $i->category_id ?>"  <?php echo  set_select('category', $i->category_id ); ?>><?= $i->category_name ?></option>
                  <?php } ?>
                  </select>
                </div>
                  <input type="hidden" name="action" value="add">
                <div class="form-group">
                  <label for="name">
                    Product Name:
                  </label>
                  <input type="text" name="name" class="form-control" value="<?= set_value('name'); ?>" placeholder="Product Name">
                </div>
                <div class="form-group">
                  <label for="Price">
                    Price:
                  </label>
                  <input type="number" name="price" min="1" step="any" class="form-control" value="<?= set_value('price'); ?>" placeholder="Price">
                </div>
                <div class="form-group">
                  <label for="Desc">
                    Description:
                  </label> 
                <textarea name="description" class="form-control" rows="4" cols="50"><?= set_value('description'); ?></textarea>
                </div>
                <div class="form-group">
                  <label for="Unit">
                    Image:
                  </label> 
                <input type="file" name="image"/>
                </div>
                
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->