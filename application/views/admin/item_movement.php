
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
            <!--  <div class="pull-right">
                    <form action="<?= base_url() ?>admin/item_movement/<?=$id?>" method="POST"> 
                        <input type="date" name="from"> to
                        <input type="date" name="to"> 
                        <button type="submit">Submit</button>
<?php echo form_error('to', '<div class="error"><font color="red">', '</font></div>'); ?>
                    </form>
              </div>      -->           
             <!-- endmessage -->
            <!-- /.box-header -->
            <br>
            <br>
            <div class="box-body">
<?php
//               $from = new DateTime($_POST['from']);
//               $to = new DateTime($_POST['to']);

// $daterange = new DatePeriod($from, new DateInterval('P1D'), $to);
// var_dump($report);die();
// foreach($daterange as $date){
//     echo $date->format("m-d-Y") . "<br>";

//     foreach ($report as $i) {
       
//      } 
// }

?>
         <table class="table table-bordered table-striped" style="width: 60%; margin: auto; border: 3px">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Invoice/Order #</th>
                  <th>Remarks</th>     
                  <th>In</th>
                  <th>Out</th>
                  <th style="border-left: solid 3px;">Balance</th>
                </tr>
                </thead>
                <tbody>


                <?php 
                $total = 0;
                foreach ($report as $i) { ?>
                
                <tr>  
                  <td><?php $date = new DateTime($i->idate);
                      echo $date->format('Y-m-d');
                  ?></td>
                  <td><?=$i->invoice_no, $i->order_id?></td>
                  <td><?php echo $i->remarks; ?></td>
                  <td><?php echo ($i->invoice_no ? $i->qty : NULL) ?></td>
                  <td><?php echo ($i->invoice_no ? NULL : $i->qty) ?></td>
                  <td style="border-left: solid 3px;"><?php echo ($i->invoice_no ? $total+=$i->qty : $total-=$i->qty) ?></td>
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


