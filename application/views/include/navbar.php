

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
                  <a href="#" onclick="edit_record(<?=$this->ion_auth->user()->row()->id;?>)" class="btn btn-default btn-flat">Ubah Password</a>
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
function edit_record(id)
{
    save_method = 'update';
    $('#form-ubahpassword')[0].reset(); 
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $("#error_pass").html('');
    $("#error_confirmpass").html('');
 
    //Ajax Load data from ajax  
    $.ajax({
        url : "<?php echo base_url('user/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="iduser"]').val(data.id);
            $('#modal_changepassword').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Program Studi'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function changepassword()
{
    $('#form-ubahpassword')[0].reset(); 
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $("#error_pass").html('');
    $("#error_confirmpass").html('');
    $('#btnSaveubahpass').text('saving...');
    $('#btnSaveubahpass').attr('disabled',true); 

    $.ajax({
        url : "<?php echo site_url('user/changepassword')?>",
        type: "POST",
        data: $('#form-ubahpassword').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            
            if (data.hasil !== "sukses") {
                $("#error_pass").html(data.error.password);
                $("#error_confirmpass").html(data.error.confirmpassword);
                $("#error_cekpass").html(data.error.cekpassword);
            }
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_changepassword').modal('hide');
                reload_table();
            }
 
            $('#btnSaveubahpass').text('Simpan'); //change button text
            $('#btnSaveubahpass').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSaveubahpass').text('Simpan'); //change button text
            $('#btnSaveubahpass').attr('disabled',false); //set button enable 
 
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
                <form id="form-ubahpassword" class="form-horizontal" style="font-size:12px">
                    <input type="hidden" value="" name="iduser" /> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-4">Username</label>
                            <div class="col-md-8">
                                <input readonly="readonly" id="user" name="user" class="form-control" type="text" value="<?= $this->session->userdata('identity'); ?>">
                                <span class="text-danger" id="error_user"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Password</label>
                            <div class="col-md-8">
                                <input id="pass" name="pass" placeholder="Password" class="form-control" type="password">
                                <span class="text-danger" id="error_pass"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Konfirmasi Password</label>
                            <div class="col-md-8">
                                <input id="pass_confirm" name="pass_confirm" placeholder="Konfirmasi Password" class="form-control" type="password">
                                <span class="text-danger" id="error_confirmpass"></span><br><span class="text-danger" id="error_cekpassword"></span>
                            </div>
                        </div>
                    </div>
                                
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" id="btnSaveubahpass" onclick="changepassword()" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
 