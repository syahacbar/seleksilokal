<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

<section class="content">
  <div class="box">
   <div class="box-header">
     <h3 class="box-title">Master Data Peserta</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
     <a href="<?=base_url('peserta/create');?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data </a>
     <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#modal-import"> <i class="fa fa-excel"></i> Import Excel </a> 
     <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        
   <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="mytable" style="font-size: 10px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Peserta</th>
                    <th>Nama Peserta</th>
                    <th>Pilihan 1</th>
                    <th>Pilihan 2</th>
                    <th>Pilihan 3</th>
                    <th width="200px">Aksi</th>
                </tr>
            </thead>
	    
        </table>

        </div>
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->
</section>  
 <!-- Modal Import Peserta-->
        <div class="modal fade" id="modal-import">
          <div class="modal-dialog">
            <div class="modal-content">
            <?php echo form_open_multipart('peserta/importpeserta'); ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
              <?php echo form_upload('file'); ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <?php echo form_submit('submit','Upload File','class="btn btn-primary"');  ?>
              </div>
              <?php echo form_close(); ?>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

    <!-- Modal delete Peserta-->
    <form id="add-row-form" action="<?php echo site_url('peserta/delete');?>" method="post">
         <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel">Hapus Data Peserta</h4>
                   </div>
                   <div class="modal-body">
                           <input type="hidden" name="nopeserta" class="form-control" required>
                                                 <strong>Are you sure to delete this record?</strong>
                   </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success">Yes</button>
                   </div>
                    </div>
            </div>
         </div>
     </form>
 
        <script src="<?php echo base_url('public/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('public/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('public/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
         
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "peserta/json", "type": "POST"},
                    columns: [
                        {
                            "data": "nopeserta",
                            "orderable": false
                        },{"data": "nopeserta"},{"data": "namapeserta"},{"data": "pilihan1"},{"data": "pilihan2"},{"data": "pilihan3"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[1, 'asc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
                
                // get delete Records
                $('#mytable').on('click','.delete_record',function(){
                    var code=$(this).data('code');
                    $('#ModalDelete').modal('show');
                    $('[name="nopeserta"]').val(code);
                });
                // End delete Records
            });
            function reload_table()
            {
                var table = $('#mytable').DataTable();
    
                table.ajax.reload( function ( json ) {
                    $('#myInput').val( json.lastInput );
                } );
            }
        </script>

<script>
    $("#view_users").addClass('active');
</script>        

