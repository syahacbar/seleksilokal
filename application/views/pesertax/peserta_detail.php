<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Peserta</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
           
            <?php echo form_open(base_url('peserta/add'), 'class="form-horizontal"');  ?> 
            <div class="form-group">
                <label for="nopeserta" class="col-sm-2 control-label">No. Peserta</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" value="<?=$nopeserta;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="namapeserta" class="col-sm-2 control-label">Nama Peserta</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$namapeserta;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="tempatlahir" class="col-sm-2 control-label">Tempat Lahir</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$tempatlahir;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="tanggallahir" class="col-sm-2 control-label">Tanggal Lahir</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$tanggallahir;?>" disabled="disabled">

                </div>
              </div>

              <div class="form-group">
                <label for="jeniskelamin" class="col-sm-2 control-label">Jenis Kelamin</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$jeniskelamin;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="suku" class="col-sm-2 control-label">Suku</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$suku;?>" disabled="disabled">
                </div>
              </div>
            
              <div class="form-group">
                <label for="pilihan1" class="col-sm-2 control-label">Pilihan 1</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$pilihan1;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="pilihan2" class="col-sm-2 control-label">Pilihan 2</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$pilihan2;?>" disabled="disabled">
                </div>
              </div>

                <div class="form-group">
                <label for="pilihan3" class="col-sm-2 control-label">Pilihan 3</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$pilihan3;?>" disabled="disabled">
                </div>
              </div>

                <div class="form-group">
                    <label for="jenjangslta" class="col-sm-2 control-label">Jenjang SLTA</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?=$jenjangslta;?>" disabled="disabled">
                    </div>
                </div>

                 <div class="form-group">
                    <label for="jurusanslta" class="col-sm-2 control-label">Jurusan SLTA</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?=$jurusanslta;?>" disabled="disabled">
                    </div>
                </div>

                <div class="form-group">
                <label for="tahunlulus" class="col-sm-2 control-label">Tahun Lulus</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$tahunlulus;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="asalslta" class="col-sm-2 control-label">Asal SLTA</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$asalslta;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="nbahasa" class="col-sm-2 control-label">Nilai Bahasa</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$nbahasa;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="nipa" class="col-sm-2 control-label">Nilai IPA</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$nipa;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="nips" class="col-sm-2 control-label">Nilai IPS</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$nips;?>" disabled="disabled">
                </div>
              </div>

              <div class="form-group">
                <label for="nverbal" class="col-sm-2 control-label">Nilai Verbal</label>

                <div class="col-sm-9">
                <input type="text" class="form-control" value="<?=$nverbal;?>" disabled="disabled">
                </div>
              </div>
           
              
              <div class="form-group">
                <div class="col-md-11">
                  <a href="<?php echo site_url('peserta');?>" class="btn btn-info pull-right"> Kembali </a>
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 


<script>
$("#add_user").addClass('active');
 //Date picker
 $('#datepicker').datepicker({
      autoclose: true
    });

</script> 