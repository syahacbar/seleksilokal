<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Tambah Program Studi</h3>
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
           
            <?php echo form_open(base_url('prodi/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="namaprodi" class="col-sm-2 control-label">Nama Program Studi</label>

                <div class="col-sm-9">
                  <input type="text" name="namaprodi" class="form-control" id="namaprodi" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="dayatampung" class="col-sm-2 control-label">Daya Tampung</label>

                <div class="col-sm-9">
                  <input type="number" name="dayatampung" class="form-control" id="dayatampung" placeholder="">
                </div>
              </div>
            
              <div class="form-group">
                <label for="namafakultas" class="col-sm-2 control-label">Fakultas</label>

                <div class="col-sm-9">
                <?php echo form_dropdown('idfakultas', $dd_fakultas, $fakultas_selected,'class="form-control select2"'); ?>
                </div>
              </div>
   
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Simpan" class="btn btn-info pull-right">
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
</script> 