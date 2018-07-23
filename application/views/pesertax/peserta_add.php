<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Peserta</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
           
            <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="nopeserta" class="col-sm-2 control-label">No. Peserta</label>

                <div class="col-sm-9">
                  <input type="text" name="nopeserta" class="form-control" id="nopeserta" value="<?=$nopeserta;?>" placeholder="" readonly="readonly">
                </div>
              </div>

              <div class="form-group">
                <label for="namapeserta" class="col-sm-2 control-label">Nama Peserta</label>

                <div class="col-sm-9">
                  <input type="text" name="namapeserta" class="form-control" id="namapeserta" placeholder="Nama Lengkap" value="<?=$namapeserta;?>">
                </div>
              </div>

              <div class="form-group">
                <label for="tempatlahir" class="col-sm-2 control-label">Tempat Lahir</label>

                <div class="col-sm-9">
                  <input type="text" name="tempatlahir" class="form-control" id="tempatlahir" placeholder="Tempat Lahir" value="<?=$tempatlahir;?>">
                </div>
              </div>

              <div class="form-group">
                <label for="tanggallahir" class="col-sm-2 control-label">Tanggal Lahir</label>

                <div class="col-sm-9">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="tanggallahir" class="form-control" id="tanggallahir" placeholder="Tanggal-Bulan-Tahun, Contoh: 31-12-2000" value="<?=$tanggallahir;?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="jeniskelamin" class="col-sm-2 control-label">Jenis Kelamin</label>

                <div class="col-sm-9">
                  <input type="radio" name="jeniskelamin" class="minimal" value="L" <?=$jeniskelamin=="L" ? "checked" : "";?>> LAKI-LAKI
                  <input type="radio" name="jeniskelamin" class="minimal" value="P" <?=$jeniskelamin=="P" ? "checked" : "";?>> PEREMPUAN
                </div>
              </div>

              <div class="form-group">
                <label for="suku" class="col-sm-2 control-label">Suku</label>

                <div class="col-sm-9">
                  <input type="radio" name="suku" class="minimal" value="P" <?=$suku=="P" ? "checked" : "";?>> PAPUA
                  <input type="radio" name="suku" class="minimal" value="NP" <?=$suku=="NP" ? "checked" : "";?>> NON PAPUA
                </div>
              </div>
            
              <div class="form-group">
                <label for="pilihan1" class="col-sm-2 control-label">Pilihan 1</label>

                <div class="col-sm-9">
                <?php echo form_dropdown('pilihan1', $dd_prodi, $p1_selected,'class="form-control select2"'); ?>
                </div>
              </div>

              <div class="form-group">
                <label for="pilihan2" class="col-sm-2 control-label">Pilihan 2</label>

                <div class="col-sm-9">
                <?php echo form_dropdown('pilihan2', $dd_prodi, $p2_selected,'class="form-control select2"'); ?>
                </div>
              </div>

                <div class="form-group">
                <label for="pilihan3" class="col-sm-2 control-label">Pilihan 3</label>

                <div class="col-sm-9">
                <?php echo form_dropdown('pilihan3', $dd_prodi, $p3_selected,'class="form-control select2"'); ?>
                </div>
              </div>

                <div class="form-group">
                    <label for="jenjangslta" class="col-sm-2 control-label">Jenjang SLTA</label>
                    <div class="col-sm-9">
                    <?php echo form_dropdown('jenjangslta', $dd_jenjangslta, $jenjang_selected,'class="form-control select2"'); ?>
                    
                    </div>
                </div>

                 <div class="form-group">
                    <label for="jurusanslta" class="col-sm-2 control-label">Jurusan SLTA</label>
                    <div class="col-sm-9">
                    <?php echo form_dropdown('jurusanslta', $dd_jurusanslta, $jurusan_selected,'class="form-control select2"'); ?>
                    
                    </div>
                </div>

                <div class="form-group">
                <label for="tahunlulus" class="col-sm-2 control-label">Tahun Lulus</label>

                <div class="col-sm-9">
                  <input type="number" name="tahunlulus" class="form-control" id="tahunlulus" placeholder="Tahun Terakhir Lulus" value="<?=$tahunlulus;?>" >
                </div>
              </div>

              <div class="form-group">
                <label for="asalslta" class="col-sm-2 control-label">Asal SLTA</label>

                <div class="col-sm-9">
                  <input type="text" name="asalslta" class="form-control" id="asalslta" placeholder="Nama Asal Sekolah" value="<?=$asalslta;?>">
                </div>
              </div>

              <div class="form-group">
                <label for="nbahasa" class="col-sm-2 control-label">Nilai Bahasa</label>

                <div class="col-sm-9">
                <input type="number"  name="nbahasa" class="form-control" id="nbahasa" min="0" step=".01" value="<?=$nbahasa;?>"  placeholder="Penulisan Desimal Menggunakan Titik, Contoh : 75.33">
                </div>
              </div>

              <div class="form-group">
                <label for="nipa" class="col-sm-2 control-label">Nilai IPA</label>

                <div class="col-sm-9">
                  <input type="number" name="nipa" class="form-control" id="nipa" min="0" step=".01" value="<?=$nipa;?>"  placeholder="Penulisan Desimal Menggunakan Titik, Contoh : 75.33">
                </div>
              </div>

              <div class="form-group">
                <label for="nips" class="col-sm-2 control-label">Nilai IPS</label>

                <div class="col-sm-9">
                  <input type="number" name="nips" class="form-control" id="nips" min="0" step=".01" value="<?=$nips;?>" placeholder="Penulisan Desimal Menggunakan Titik, Contoh : 75.33">
                </div>
              </div>

              <div class="form-group">
                <label for="nverbal" class="col-sm-2 control-label">Nilai Verbal</label>

                <div class="col-sm-9">
                  <input type="number" name="nverbal" class="form-control" id="nverbal" min="0" step=".01" value="<?=$nverbal;?>" placeholder="Penulisan Desimal Menggunakan Titik, Contoh : 75.33">
                </div>
              </div>
           
              <input type="hidden" name="tahunakademik" value="<?php echo date('Y').'/'.date('Y')+1; ?>">
              <input type="hidden" name="status" value="B">
              
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Simpan" class="btn btn-info pull-right">
                </div>
              </div>
            </form>
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