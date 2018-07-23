<!-- Datatable style -->
<link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?php echo base_url('public/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('public/fixedColumns.dataTables.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('public/select.dataTables.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('public/buttons.dataTables.min.css')?>">

<style>
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
    tr { height: 10px;  }
</style>     
  <div class="box"> 
    <div class="box-header">
        <h3 class="box-title">Seleksi Calon Mahasiswa Baru Universitas Papua Jalur Lokal TA. 2018/2019</h3>  
        <div class="pull-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-success">Terima Kolektif</button>
                  <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Di Pilihan 1</a></li>
                    <li><a href="#">Di Pilihan 2</a></li>
                    <li><a href="#">Di Pilihan 3</a></li>
                  </ul>
                </div>
                <button class="btn btn-sm btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                
        </div>
   </div>
   <!-- /.box-header -->
  
        <div class="box-body table-responsive">
        <form action="#" id="form" class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label" style="font-size:13px;">Pilih Program Studi</label>
            <div class="col-sm-3">
                <?php echo form_dropdown('pilihprodi', $dd_prodi, $prodi_selected,'id="pilihprodi" class="form-control select2" style="font-size:12px;max-height:30px;"'); ?>
            </div>
            <button type="button" id="btnSave" onclick="save()" class="btn btn-sm btn-primary">Tampilkan</button>
        </div>  
        </form>               
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size:12px;">
               
        <thead>
                <tr>
                    <th></th>
                    <th>No. Peserta</th>
                    <th>Nama Peserta</th>
                    <th>Pilihan 1</th>
                    <th>Pilihan 2</th>
                    <th>Pilihan 3</th>
                    <th>Suku</th>
                    <th>N. Bahasa</th>
                    <th>N. IPA</th>
                    <th>N. IPS</th>
                    <th>N. Verbal</th>
                    <th>N. Rata-Rata</th>
                    <th>Tahun Lulus</th>
                    <th>Status</th>
                    <th style="width:200px; text-align: center;">Aksi</th>
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
<script src="<?php echo base_url('public/jquery-3.3.1.js')?>"></script>  
<script src="<?php echo base_url('public/jquery.dataTables.min.js')?>"></script>  
<script src="<?php echo base_url('public/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>  
<script src="<?php echo base_url('public/dataTables.select.min.js')?>"></script> 
<script src="<?php echo base_url('public/dataTables.fixedColumns.min.js')?>"></script> 
<script src="<?php echo base_url('public/dataTables.buttons.min.js')?>"></script> 
<script src="<?php echo base_url('public/buttons.html5.min.js')?>"></script> 
<script src="<?php echo base_url('public/buttons.print.min.js')?>"></script> 

<script type="text/javascript">
 
var save_method; //for save method string
var table;

$(document).ready(function() {
    $("#mnpendaftar").addClass('active');
    //datatables
    table = $('#table').DataTable({ 
        
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        ajax: {
            "url": "<?php echo site_url('seleksimanual/ajax_list')?>",
            "type": "POST",
        },
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            fixedColumns:   {
            leftColumns: 3,
        },
        
        //Set column definition initialisation properties.
        columnDefs: [
        { 
            targets: [ -1 ], //last column
            orderable: false, //set not orderable
            width: '200px',
        },
        {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        },
        {
            targets:   0,
            width: '20',
        },
        { 
            orderable: false,
            targets: [3,4,5], 
        },
        
        ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },

        
    });

    load_data();

    function load_data(is_prodi){
        var dataTable = $('#table').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url: "<?php echo site_url('seleksimanual/tampilprodi')?>",
                type:"POST",
                data:{is_prodi:is_prodi}
            },
            "columnDefs":[
            {
                "targets":[1],
                "orderable":false,
            },
            ],
        });
    }

    $(document).on('change', '#pilihprodi', function(){
        var prodi = $(this).val();
        $('#table').DataTable().destroy();
        if(prodi != '')
        {
            load_data(prodi);
        }
        else
        {
            load_data();
        }
    });

});
 
function detail_record(id)
{ 
    //table.ajax.reload(null,false);
    save_method = 'detail';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url('pendaftar/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nopendaftar"]').val(data.nopendaftar);
            $('[name="namapendaftar"]').val(data.namapendaftar);
            $('[name="ttl"]').val(data.tempatlahir+", "+data.tanggallahir);
            $('[name="tanggallahir"]').val(data.tanggallahir);

            var jk = data.jeniskelamin;
            var suku = data.suku;
            if (jk=='L') jk='LAKI-LAKI'; else  jk='PEREMPUAN';
            if (suku=='P') jk='PAPUA'; else  jk='NON PAPUA';
            
            $('[name="jeniskelamin"]').val(jk);
            $('[name="suku"]').val(data.suku);
            $('[name="pilihan1"]').val(data.pilihan1);
            $('[name="pilihan2"]').val(data.pilihan2);        
            $('[name="pilihan3"]').val(data.pilihan3);
            $('[name="jenjangslta"]').val(data.jenjangslta);
            $('[name="jurusanslta"]').val(data.jurusanslta);        
            $('[name="asalslta"]').val(data.asalslta);        
            $('[name="tahunlulus"]').val(data.tahunlulus);
            $('[name="nbahasa"]').val(data.nbahasa);
            $('[name="nipa"]').val(data.nipa);
            $('[name="nips"]').val(data.nips);
            $('[name="nverbal"]').val(data.nverbal);
            $('[name="status"]').val(data.status);
            $('[name="tahunakademik"]').val(data.tahunakademik);
            $('.modal-title').text('Data Pendaftar'); // Set title to Bootstrap modal title
            $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Data Pendaftar</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">No. Pendaftar</label>
                            <div class="col-md-9">
                                <input name="nopendaftar"  class="form-control" type="text" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Pedaftar</label>
                            <div class="col-md-9">
                                <input name="namapendaftar"  readonly="readonly" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tempat, Tgl. Lahir</label>
                            <div class="col-md-5">
                                <input name="ttl"  readonly="readonly" class="form-control" type="text">
                            </div>
                            <div class="col-md-4">
                                <input name="tanggallahir" type="text" readonly="readonly" class="form-control pull-right" id="datepicker">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <input name="jeniskelamin" id="jeniskelamin" readonly="readonly" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Suku</label>
                            <div class="col-md-9">
                                <input name="suku" id="suku" readonly="readonly" class="form-control" type="text">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Pilihan 1</label>
                            <div class="col-md-9">
                                <input name="pilihan1" id="pilihan1" readonly="readonly" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Pilihan 2</label>
                            <div class="col-md-9">
                                <input name="pilihan2" id="pilihan2" readonly="readonly" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Pilihan 3</label>
                            <div class="col-md-9">
                                <input name="pilihan3" id="pilihan3" readonly="readonly" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6">Jenjang SLTA</label>
                            <label class="col-md-6">Jurusan SLTA</label>
                            <div class="col-md-6">
                                <input name="jenjangslta" id="jenjangslta" readonly="readonly" class="form-control" type="text">
                            </div>
                            <div class="col-md-6">
                            <input name="jurusanslta" id="jurusanslta" readonly="readonly" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-9">Asal SLTA</label>
                            <label class="col-md-3">Tahun Lulus</label>
                            <div class="col-md-9">
                                <input name="asalslta" id="asalslta" readonly="readonly" class="form-control" type="text">
                                <span class="text-danger" id="error_asalslta"></span>
                            </div>
                            <div class="col-md-3">
                                <input name="tahunlulus" readonly="readonly" class="form-control" type="number">
                                <span class="text-danger" id="error_tahunlulus"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-center">Nilai Bahasa</label>
                            <label class="col-md-3 text-center">Nilai IPA</label>
                            <label class="col-md-3 text-center">Nilai IPS</label>
                            <label class="col-md-3 text-center">Nilai Verbal</label>
                        
                            <div class="col-md-3">
                                <input name="nbahasa" readonly="readonly" class="form-control" type="number">
                                <span class="text-danger" id="error_nbahasa"></span>
                            </div>
                            <div class="col-md-3">
                                <input name="nipa" readonly="readonly" class="form-control" type="number">
                                <span class="text-danger" id="error_nipa"></span>
                            </div>
                            <div class="col-md-3">
                                <input name="nips" readonly="readonly" class="form-control" type="number">
                                <span class="text-danger" id="error_nips"></span>
                            </div>
                            <div class="col-md-3">
                                <input name="nverbal" readonly="readonly" class="form-control" type="number">
                                <span class="text-danger" id="error_nverbal"></span>
                            </div>
                        </div>
                        
                    </div>
                    <input name="status" type="hidden">
                    <input name="tahunakademik" type="hidden">
                                
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<!-- Modal Import Excel-->
        <div class="modal fade" id="modal_import">
          <div class="modal-dialog">
            <div class="modal-content">
            <?php echo form_open_multipart('pendaftar/importexcel'); ?>
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
</body>
</html>