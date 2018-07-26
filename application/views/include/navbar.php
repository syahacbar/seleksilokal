

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('dashboard');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?= base_url() ?>public/dist/img/logo.png" width="30" height="30" alt="Sistem Admisi Unipa"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?= base_url() ?>public/dist/img/logo.png" width="45" height="45" alt="Sistem Admisi Unipa"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url() ?>public/dist/img/dosen.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->session->userdata('identity'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url() ?>public/dist/img/dosen.png" class="img-circle" alt="User Image">
                <?php
                  if($this->ion_auth->user()->row()->company=='ADMIN'){
                    echo '<p>ADMINISTRATOR</p>';
                  } else {
                    echo '<p class="font-size:10px;">'.$this->ion_auth->get_fakultas()->namafakultas.'</p>';
                  }
                ?>              
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Log Out</a>
                </div>
                <div class="pull-left">
                  <a href="#" onclick="ubah_password()" class="btn btn-default btn-flat">Ubah Password</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav> 
  </header>

<script type="text/javascript">

function changepassword()
{
    $('#form-changepassword')[0].reset(); 
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $("#error_password").html('');
    $("#error_confirmpassword").html('');
    $('#btnSave').text('saving...');
    $('#btnSave').attr('disabled',true); 

    $.ajax({
        url : "<?php echo site_url('user/changepassword')?>",
        type: "POST",
        data: $('#form-changepassword').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            
            if (data.hasil !== "sukses") {
                $("#error_password").html(data.error.password);
                $("#error_confirmpassword").html(data.error.confirmpassword);
                $("#error_cekpassword").html(data.error.cekpassword);
            }
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_changepassword').modal('hide');
                reload_table();
            }
 
            $('#btnSave').text('Simpan'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Simpan'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
    
}
</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_changepassword" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Form Ubah Passowrd </h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form-changepassword" class="form-horizontal" style="font-size:12px">
                    <input type="hidden" name="id"/> 
                    <div class="form-body">
                        <div class="form-group" id="div_password">
                            <label class="control-label col-md-4">Username</label>
                            <div class="col-md-8">
                                <input readonly="readonly" id="username" name="username" class="form-control" type="text" value="<?= $this->session->userdata('identity'); ?>">
                                <span class="text-danger" id="error_username"></span>
                            </div>
                        </div>
                        <div class="form-group" id="div_password">
                            <label class="control-label col-md-4">Password</label>
                            <div class="col-md-8">
                                <input id="password" name="password" placeholder="Password" class="form-control" type="password">
                                <span class="text-danger" id="error_password"></span>
                            </div>
                        </div>
                        <div class="form-group"  id="div_password_confirm">
                            <label class="control-label col-md-4">Konfirmasi Password</label>
                            <div class="col-md-8">
                                <input id="password_confirm" name="password_confirm" placeholder="Konfirmasi Password" class="form-control" type="password">
                                <span class="text-danger" id="error_confirmpassword"></span><br><span class="text-danger" id="error_cekpassword"></span>
                            </div>
                        </div>
                    </div>
                                
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSave" onclick="changepassword()" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
 