<?php  var_dump($report);die(); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item Movement
      </h1>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
             <!-- message -->
             <div class="pull-right">
                    <form action="<?= base_url() ?>admin/item_movement/<?=$id?>" method="POST"> 
                        <input type="date" name="from"> to
                        <input type="date" name="to"> 
                        <button type="submit">Submit</button>
<?php echo form_error('to', '<div class="error"><font color="red">', '</font></div>'); ?>
                    </form>
              </div>                
             <!-- endmessage -->
            <!-- /.box-header -->
            <div class="box-body">
<?php
              $from = new DateTime($_POST['from']);
              $to = new DateTime($_POST['to']);

$daterange = new DatePeriod($from, new DateInterval('P1D'), $to);
var_dump($report);die();
foreach($daterange as $date){
    echo $date->format("m-d-Y") . "<br>";

    foreach ($report as $i) {
       
     } 
}

?>
              <!-- <table class="table table-bordered table-striped">
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
              </table> -->
            </div>
            <!-- /.box-body -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


