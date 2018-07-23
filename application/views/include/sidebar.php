<?php 
$cur_tab = $this->uri->segment(1)==''?'dashboard': $this->uri->segment(1); 
?>  

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('public/dist/img/dosen.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('identity'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li id="mndashboard"><a href="<?= site_url('dashboard'); ?>"><i class="glyphicon glyphicon-home"></i> <span>Dashboard</span></a></li>

        <li <?php if ($this->uri->segment(1)=='jenjangslta' || $this->uri->segment(1)=='jurusanslta' || $this->uri->segment(1)=='sekolah' || $this->uri->segment(1)=='fakultas' || $this->uri->segment(1)=='prodi' || $this->uri->segment(1)=='pendaftar') { echo 'class="active"'; } ?>) class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-book"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php  if($this->ion_auth->is_admin()){ ?>
            <li id="mndatauser"><a href="<?= site_url('user'); ?>"><i class="glyphicon glyphicon-user"></i> Data User</a></li>
            <li id="mnfakultas"><a href="<?= site_url('fakultas'); ?>"><i class="glyphicon glyphicon-ok-sign"></i> Data Fakultas</a></li>
          <?php } ?>
            <li id="mnprodi"><a href="<?= site_url('prodi'); ?>"><i class="glyphicon glyphicon-ok-sign"></i> Data Prodi</a></li>
            <li id="mnpendaftar"><a href="<?= site_url('pendaftar'); ?>"><i class="glyphicon glyphicon-ok-sign"></i> Data Pendaftar</a></li>
          </ul>
        </li>
        <li <?php if ($this->uri->segment(1)=='seleksimanual' || $this->uri->segment(1)=='seleksiotomatis' ) { echo 'class="active"'; } ?>) class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-list-alt"></i> <span>Seleksi</span>
            <span class="pull-right-container">
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="mnseleksimanual"><a href="<?= site_url('seleksimanual'); ?>" ><i class="glyphicon glyphicon-ok-sign"></i> Seleksi Manual</a></li>
          </ul>
        </li>
        <li <?php if ($this->uri->segment(1)=='penerimaan' || $this->uri->segment(1)=='rekapitulasi' ) { echo 'class="active"'; } ?>) class="treeview">
          <a href="#">
            <i class="	glyphicon glyphicon-folder-open"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="glyphicon glyphicon-chevron-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="mnpenerimaan"><a href="<?= site_url('penerimaan'); ?>"><i class="glyphicon glyphicon-ok-sign"></i> Penerimaan</a></li>
            <li id="mnrekapitulasi"><a href="<?= site_url('laporan/rekapitulasi'); ?>"><i class="glyphicon glyphicon-ok-sign"></i> Rekapitulasi</a></li>
          </ul>
        </li>
        <?php  if($this->ion_auth->is_admin()){ ?>
        <li id="mnpengaturan"><a href="<?= site_url('pengaturan'); ?>"><i class="glyphicon glyphicon-wrench"></i> <span>Pengaturan</span></a></li>
        <?php } ?>
      </ul>

     


    </section>
    <!-- /.sidebar -->
  </aside>

  
<script>
  $("#mn<?= $cur_tab; ?>").addClass('active');
</script>
