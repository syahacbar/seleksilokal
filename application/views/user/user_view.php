<!-- Datatable style -->
<link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">

<style>
    th, td { white-space: nowrap; } 
    div.dataTables_wrapper {
        margin: 0 auto;
    }
    tr { height: 10px;  }
    table{
    table-layout: fixed; 
    word-wrap:break-word;
    }
    th.dt-center, td.dt-center { text-align: center; }
</style>      

  <div class="box">
   <div class="box-header">
     <h3 class="box-title">Master Data User</h3>
     <div class="pull-right">
        <button class="btn btn-sm btn-success" onclick="add_record()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
        <button class="btn btn-sm btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        
     </div>
   </div>
        <div class="box-body table-responsive">
        <table id="table" class="table table-striped table-bordered" cellspacing="0" style="font-size:12px;">
            <thead>
                <tr>
                    <th width="20px">No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created On</th>
                    <th>Last Login</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
 
           
        </table>
        </div>
 
   <!-- /.box-body -->
 </div>
 <!-- /.box --> 

<script src="<?php echo base_url('public/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('public/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('public/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('public/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
 
var save_method; //for save method string
var table;

$(document).ready(function() {
    $("#mndatauser").addClass('active');
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('user/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0,-1], //last column
            "orderable": false, //set not orderable
                "className": 'dt-center',
        },
        ],
 
    });
 
    
 
});
 
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

</script>

</body>
</html>