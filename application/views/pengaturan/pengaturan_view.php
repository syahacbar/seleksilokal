<!-- Datatable style -->
    <link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Pengaturan Sistem</h3> 
    </div>
    <div class="box-body">
            <div class="form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Aktifkan Sesi Pilihan </label>
                            <div class="col-md-2">
                                <?php echo form_dropdown('sesipilihan', $dd_sesipilihan, $sesipilihan_selected,'id="sesipilihan" class="form-control select2"'); ?>
                            </div>
                            <div class="col-md-2">
                            <button type="button" id="btnsavesesipilihan" onclick="savesesipilihan()" class="btn btn-primary">Simpan</button>
                            <span class="text-danger" id="sukses_sesipilihan"></span>    
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Tahun Akademik</label>
                            <div class="col-md-2">
                                <?php echo form_dropdown('tahunakademik', $dd_tahunakademik, $tahunakademik_selected,'id="tahunakademik" class="form-control select2"'); ?>
                            </div>
                            <div class="col-md-2">
                            <button type="button" id="btnsavetahunakademik" onclick="savetahunakademik()" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Nama Rektor</label>
                            <div class="col-md-3">
                            <input name="namarektor" id="namarektor" class="form-control" type="text">
                            </div>
                            <div class="col-md-2">
                            <button type="button" id="btnsavenamarektor" onclick="savenamarektor()" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">NIP Rektor</label>
                            <div class="col-md-3">
                            <input name="niprektor" id="niprektor" class="form-control" type="text">
                            </div>
                            <div class="col-md-2">
                            <button type="button" id="btnsaveniprektor" onclick="saveniprektor()" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Status User</label>
                            <div class="col-md-3">
                            <?php echo form_dropdown('statususer', $dd_statususer, $statususer_selected,'id="statususer" class="form-control select2"'); ?>
                            </div>
                            <div class="col-md-2">
                            <button type="button" id="btnsavestatususer" onclick="savestatususer()" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>
 <!-- /.box -->

<script src="<?php echo base_url('public/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('public/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('public/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('public/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>

<script type="text/javascript">
$(document).ready(function() {
     $("#mnpengaturan").addClass('active');
    $.ajax({
            type: "POST",
            url: "<?php echo site_url('pengaturan/pengaturan_list')?>",
            dataType: 'JSON',
            success: function(data){
                $('[name="namarektor"]').val(data.namarektor);
                $('[name="niprektor"]').val(data.niprektor);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal Proses');
            }
        });
}); 

function savesesipilihan(){
    var sesipilihan = $('#sesipilihan').val();
    $.ajax({
        url : "<?php echo base_url('pengaturan/simpansesipilihan')?>",
        type: "POST",
        dataType: "JSON",
        data: {'sesipilihan': sesipilihan},
        success: function(data)
        {
            if (data.hasil == "sukses") {
                alert('Perubahan Sesi Pilihan berhasil disimpan.');
            }
        }
    });
}

function savetahunakademik(){
    var tahunakademik = $('#tahunakademik').val();
    $.ajax({
        url : "<?php echo base_url('pengaturan/simpantahunakademik')?>",
        type: "POST",
        dataType: "JSON",
        data: {'tahunakademik': tahunakademik},
        success: function(data)
        {
            if (data.hasil == "sukses") {
                alert('Perubahan Tahun Akademik berhasil disimpan.');
            }
        }
    });
}

function savenamarektor(){
    var namarektor = $('#namarektor').val();
    $.ajax({
        url : "<?php echo base_url('pengaturan/simpannamarektor')?>",
        type: "POST",
        dataType: "JSON",
        data: {'namarektor': namarektor},
        success: function(data)
        {
            if (data.hasil == "sukses") {
                alert('Perubahan Nama Rektor berhasil disimpan.');
            }
        }
    });
}

function saveniprektor(){
    var niprektor = $('#niprektor').val();
    $.ajax({
        url : "<?php echo base_url('pengaturan/simpanniprektor')?>",
        type: "POST",
        dataType: "JSON",
        data: {'niprektor': niprektor},
        success: function(data)
        {
            if (data.hasil == "sukses") {
                alert('Perubahan NIP Rektor berhasil disimpan.');
            }
        }
    });
}


function savestatususer(){
    var statususer = $('#statususer').val();
    $.ajax({
        url : "<?php echo base_url('pengaturan/simpanstatususer')?>",
        type: "POST",
        dataType: "JSON",
        data: {'statususer': statususer},
        success: function(data)
        {
            if (data.hasil == "sukses") {
                alert('Perubahan Status User berhasil disimpan.');
            }
        }
    });
}
</script>
</body>
</html>