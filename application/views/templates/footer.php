<!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Panel Momototoy <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/');?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/');?>vendor/jquery-easing/jquery.easing.min.js"></script>


  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/');?>js/sb-admin-2.min.js"></script>

  <script src="<?= base_url('assets/');?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/');?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/');?>js/demo/datatables-demo.js"></script>
  

  <script>
    
    $(document).ready( function () {
    $('#fi').DataTable();
} );


    // $(document).ready(function(){
    //         $(document).on('submit','#keuangan', function(event){
    //           event.preventDefault();
    //           var judul = $('#judul').val();
    //           var status = $('#status').val();
    //           var tanggal = $('#tanggal').val();
    //           var nominal = $('#nominal').val();
    //           if(judul!='' && status!='' && tanggal!='' && nominal!=''){
    //             $.ajax({
    //               url:"<?php echo base_url(). 'finance/tambahdata';?>",
    //               type:'POST',
    //               data:'judul='+judul+'&status='+status+'&tanggal='+tanggal+'&nominal='+nominal,
    //               success:function(data){
    //              var objResult = JSON.parse(jios);
    //              var nomor = 1;
    //              $.each(objResult, function(key,val){
    //               var judul = $("<tr>");
    //               judul.html("<td>"+nomor+"</td><td>"+val.judul+"</td><td>"+val.status+"</td><td>"+val.tanggal+"</td><td>"+val.nominal+"</td><td><a href='' class='badge badge-success'>edit</a><a href='' class='badge badge-danger' data-toggle='modal' data-target='#hapusdata"+val.id+"'>delete</a></td>");
    //               var dataHandler = $("#jios");
    //               dataHandler.append(judul);
    //               nomor++;
    //              });                 
    //               }
    //             });
    //           }else{
   //              alert("Lengkapi isi formnya");
   //            }
   //          });
   //        });
   // ambildata(); 
   //  function ambildata(){
   //    $.ajax({
   //      type:'POST',
   //      type:'JSON',
   //      url:'<?= base_url()."finance/ambildata"; ?>',
   //      success: function(jios){
   //       var objResult = JSON.parse(jios);
   //       var nomor = 1;
   //       $.each(objResult, function(key,val){
   //        var judul = $("<tr>");
   //        judul.html("<td>"+nomor+"</td><td>"+val.judul+"</td><td>"+val.status+"</td><td>"+val.tanggal+"</td><td>"+val.nominal+"</td><td><a href='' class='badge badge-success'>edit</a><a href='' class='badge badge-danger' data-toggle='modal' data-target='#hapusdata"+val.id+"'>delete</a></td>");
   //        var dataHandler = $("#jios");
   //        dataHandler.append(judul);
   //        nomor++;
   //       })
   //        // var judul = '';
   //        // for(var i=0;i<jios.length;i++){
   //        //   judul+='<tr>'+
   //        //                 '<td>'+1+'</td>'+
   //        //                 '<td>'+jios[judul]+'</td>'+
   //        //                 '<td>'+jios.tanggal+'</td>'+
   //        //                 '<td>'+jios.status+'</td>'+
   //        //                 '<td>'+jios.nominal+'</td>'+
   //        //           '</tr>'
   //        // };

   //        // $('#jios').html(judul);
      
   //      }
   //    });
   //  }

    function hapusdata(id){
      
        $.ajax({
          type:'post',
          data:'id='+id,
          url:'<?php echo base_url().'finance/hapusdata'; ?>',
          success: function(){
           event.preventDefault();
           loadData();
          }
        });
      }

      $('#hapusdata').on('click', function(){
        event.preventDefault();
        document.location.href = "<?= base_url('finance/tambahdata/'); ?>" + id;
        hapusdata();
      });
   

            $('.custom-file-input').on('change', function(){
              let filename = $(this).val().split('\\').pop();
              $(this).next('.custom-file-label').addClass("selected").html(filename);
            });


            $('.form-check-input').on('click', function(){

              const menuId = $(this).data('menu');
              const roleId = $(this).data('role');

              $.ajax({
                url:"<?=base_url('admin/changeaccess'); ?>",
                type: 'post',
                data: {
                  menuId: menuId,
                  roleId: roleId
                },
                success: function(){
                  document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                }

              });

            });

           
  </script>

</body>

</html>
