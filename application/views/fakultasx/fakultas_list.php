
 <!-- Datatable style -->
 <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

<section class="content">
  <div class="box">
   <div class="box-header">
     <h3 class="box-title">Master Data Fakultas</h3>
   </div>
   <!-- /.box-header -->
    <div class="box-body">
     <a href="<?=base_url('fakultasx/add');?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data </a>
     <div class="box-body table-responsive">
     <table id="example1" class="table table-bordered table-striped ">
       <thead>
       <tr>
         <th>No.</th>
         <th>Fakultas</th>
         <th>Dekan</th>
         <th>Akun Pengguna</th>
         <th style="width: 150px;" class="text-right">Aksi</th>
       </tr>
       </thead>
       <tbody>
         <?php $no=1; foreach($all_fakultas as $row): ?>
         <tr>
           <td><?=$no++;?></td>
           <td><?= $row['namafakultas']; ?></td>
           <td><?= $row['namadekan']; ?></td>
           <td><?= $row['username']; ?></td>
           <td class="text-right"><a href="<?= base_url('fakultasx/edit/'.$row['idfakultas']); ?>" class="btn btn-info btn-sm btn-flat">Ubah</a>
           <a href="javascript:void(0);"  data-code="<?=$row['idfakultas'];?>" class="delete_record btn btn-danger btn-sm btn-flat <?= ($row['is_admin'] == 1)? 'disabled': ''?>">Hapus</a></td>
         </tr>
         <?php endforeach; ?>
       </tbody>
      
     </table>
   </div>
</div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->
</section>  

    <!-- Modal delete Prodi-->
    <form id="add-row-form" action="<?php echo site_url('fakultas/del');?>" method="post">
         <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel">Hapus Fakultas</h4>
                   </div>
                   <div class="modal-body">
                           <input type="hidden" name="idfakultas" class="form-control" required>
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

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
 $(function () {
   $("#example1").DataTable();
    // get delete Records
    $('#example1').on('click','.delete_record',function(){
                    var code=$(this).data('code');
                    $('#ModalDelete').modal('show');
                    $('[name="idfakultas"]').val(code);
                });
                // End delete Records
 });
</script> 
      
