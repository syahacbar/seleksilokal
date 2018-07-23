<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Ubah Fakultas</h3>
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
           
            <?php echo form_open(base_url('fakultas/edit/'.$fakultas['idfakultas']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="namafakultas" class="col-sm-2 control-label">Nama Fakultas</label>

                <div class="col-sm-9">
                  <input type="text" name="namafakultas" value="<?= $fakultas['namafakultas']; ?>" class="form-control" id="namafakultas" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="namadekan" class="col-sm-2 control-label">Nama Dekan</label>

                <div class="col-sm-9">
                  <input type="text" name="namadekan" value="<?= $fakultas['namadekan']; ?>" class="form-control" id="namadekan" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>

                <div class="col-sm-9">
                  <input type="text" name="username" value="<?= $user['username']; ?>" class="form-control" id="username" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>

                <div class="col-sm-9">
                  <input type="password" name="password"  class="form-control" id="password" placeholder="Kosongkan saja bila tidak ingin diubah">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Simpan" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 