
 <!-- Datatable style -->
 <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

<section class="content">
  <div class="box">
   <div class="box-header">
     <h3 class="box-title">Master Data Program Studi</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
     <a href="<?=base_url('prodi/add');?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data </a>
   <div class="box-body table-responsive">
     <table id="example1" class="table table-bordered table-striped ">
       <thead>
       <tr>
         <th>No.</th>
         <th>Program Studi</th>
         <th>Fakultas</th>
         <th>Daya Tampung</th>
         <th style="width: 150px;" class="text-center">Aksi</th>
       </tr>
       </thead>
       <tbody>
         <?php $no=1; foreach($all_prodi as $row): ?>
         <tr>
           <td><?=$no++;?></td>
           <td><?= $row['namaprodi']; ?></td>
           <td><?= $row['namafakultas']; ?></td>
           <td align="center"><?= $row['dayatampung']; ?></td>
           <td class="text-center"><a href="<?= base_url('prodi/edit/'.$row['idprodi']); ?>" class="btn btn-info btn-sm btn-flat">Ubah</a>
           <a href="javascript:void(0);" class="delete_record btn btn-danger btn-sm btn-flat"  data-code="<?=$row['idprodi'];?>">Hapus</a></td>
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
    <form id="add-row-form" action="<?php echo site_url('prodi/del');?>" method="post">
         <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel">Hapus Program Studi</h4>
                   </div>
                   <div class="modal-body">
                           <input type="hidden" name="idprodi" class="form-control" required>
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
                    $('[name="idprodi"]').val(code);
                });
                // End delete Records
 });
</script> 
<script>
$("#view_users").addClass('active');
</script>        
