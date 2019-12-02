  <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> <?= $user['name']?></h1>
          <?= $this->session->flashdata('message'); ?>
          <div class="row">
            <div class="col-md-12 mb-4">
               <form method="post">
            <p align="center"><font color="orange" size="3"><b>Pencarian Data Berdasarkan Periode Tanggal</b></font></p><br />
            <div class="row">
              <div class="col-md-4">
                    <b>Dari Tanggal</b>
                    <input type="date" id="tanggal_awal" name="tanggal_awal" value="<?= set_value('tanggal_awal');?>" size="16" placeholder="Masukkan tanggal awal.."/>                
                </div>
                <div class="col-md-6">
                    <b>Sampai Tanggal</b>
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="<?= set_value('tanggal_akhir');?>" size="16" placeholder="Masukkan tanggal_akhir.."  />
                    <button type="submit" class="btn btn-outline-primary" name="pencarian" />Filter</button> <input type="reset" value="Reset" class="btn btn-outline-warning" />
                  </div>
                
              </div>
        </form>
            </div>
            <div class="col-md-12 mb-4">
            <div class="card border-left-success shadow h-500 py-2">
                <div class="card-body">
                  <div class="no-gutters align-items-center">
            <div class="table-responsive">
              <table class="table table-bordered border-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <?php foreach ($produk as $p) :?>
                      <th scope="col"><?= $p['namaProduk']; ?></th>
                    <?php endforeach; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  $i=1;
                    $dayList1 = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
                           $dayList = array(
                                                          'Sunday' => 'Minggu',
                                                          'Monday' => 'Senin',
                                                          'Tuesday' => 'Selasa',
                                                          'Wednesday' => 'Rabu',
                                                          'Thursday' => 'Kamis',
                                                          'Friday' => 'Jumat',
                                                          'Saturday' => 'Sabtu'
                                                      );
                    foreach ($dayList1 as $d) :?>
                    <tr>
                      <th scope="row"><?= $i++;?></th>
                      <th scope="row"><?= $d;?></th>
                      <?php foreach ($produk as $p) :?>
                      <td>
                        <div class="card my-0 mx-0" style="width: auto;">
                          <ul class="list-group list-group-flush">
                            <?php foreach ($jadwal as $h): ?>
                            <?php $l = date('l', strtotime($h['TanggalAntar'])); 

                          
                            $kmr = mktime(0, 0, 0, date("m"), date("d")-30, date("Y"));

                            $tgl = $h['TanggalAntar'];
                            
                                                    
                            if($h['Orderan']==$p['namaProduk']&& $dayList[$l]==$d) {
                             echo '<li class="list-group-item">'. $h['NamaPemesan'].'|<span class="badge badge-danger">'. $h['JumlahUnit'].'</span> | <a href="'. $h['noRFO'].'" class="badge badge-info" data-toggle="modal" data-target="#detailjadwal'.$h['noRFO'].'">detail</a>  | '.$h['Personil'].'</li>';
                            
                          }
                            else{

                            if(isset($_POST['pencarian'])){
                                $tgla = $_POST['tanggal_awal'];
                                $tglr = $_POST['tanggal_akhir'];
                                $tgl = $h['TanggalAntar'];                           
                                                                 
                            if($h['Orderan']==$p['namaProduk']&& $dayList[$l]==$d&&$tgl>=$tgla&&$tgl<=$tglr) {
                                  echo '<li class="list-group-item">'. $h['NamaPemesan'].'|<span class="badge badge-danger">'. $h['JumlahUnit'].'</span> | <a href="'. $h['noRFO'].'" class="badge badge-info" data-toggle="modal" data-target="#detailjadwal'.$h['noRFO'].'">detail</a>  | '.$h['Personil'].'</li>';
                            }
                          }
                          }
                            ?>
                          <?php endforeach; ?>
                          </ul>
                        </div>
                      </td>
                    <?php endforeach; ?>
                    </tr>
                  <?php endforeach;?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

          <?php $i=1; ?><?php foreach ($jadwal as $h) :?>                
                            <!-- Modal -->
                           <?php echo form_open_multipart('user/tambahgambar');?>
                            <div class="modal fade" id="detailjadwal<?=$h['noRFO'];?>" tabindex="-1" role="dialog" aria-labelledby="detailjadwalModalLabel<?=$h['noRFO'];?>" aria-hidden="true">
                              <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content modal-xl">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="detailjadwalModalLabel<?=$h['noRFO'];?>">Rincian Pengiriman</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body modal-xl">

  <div class="container-fluid">
    
    <input type="hidden" id="noRFO" name="noRFO" value="<?= $h['noRFO'];?>" >
    <input type="hidden" id="Statuse" name="Statuse" value="<?= $h['Statuse'];?>" >
      <div class="row">
          <div class="col-md-3"><p class="text-left badge badge-success">No RFO : <?= $h['noRFO']; ?></p></div>
          <div class="col-md-5"><p class="text-left badge badge-success">No SJ : <?= $h['noSJ']; ?></p></div>
          <div class="col-md-4"><p class="alert alert-info">Pengantar : <b><?= $h['Personil']; ?></b></p></div>
      </div>
   
    <div class="row">
      <table class="table table-bordered">
    <thead>
      <tr>
        <th><div class="col">
            <p class="text-left">Nama Pemesan </p>
            <p class="text-left">No Telp Pemesan</p>
            <p class="text-left">Email </p>
            <p class="text-left">Nama EO/WO/Company </p>
            <p class="text-left">Alamat EO/WO/Company </p>
             <p class="text-left">Unit Yang Di Pesan  </p>
          </div></th>
        <th><div class="col">
            <p class="text-left">: <?= $h['NamaPemesan']; ?></p>
            <p class="text-left">: <a href="https://web.whatsapp.com/send?phone=<?= $h['NoTlp']; ?>&text=Hi...Saya%20dari%20Momototoy%20" class="btn btn-outline-primary" target="_blank" role="button"><i class="fab fa-whatsapp"></i>  <?= $h['NoTlp']; ?></a></p>
            <p class="text-left">: <?= $h['EmailEO']; ?></p>
            <p class="text-left">: <?= $h['NamaEO']; ?></p>
            <p class="text-left">: <?= $h['AlamatWO']; ?></p>
            <p class="text-left">: <?= $h['Orderan']; ?></p>
          </div> </th>
        <th><div class="col">           
           
            <p class="text-left">Tanggal Sewa </p>
            <p class="text-left">Lama Sewa </p>
            <p class="text-left">Tanggal Pengantaran </p>
            <p class="text-left">Venue </p>
            <p class="text-left">Alamat Venue </p>
            <p class="text-left">Alamat Antar </p>
            
          </div></th>
          <th><div class="col">            
            
            <p class="text-left">: <?= $h['TanggalSewa']; ?></p>
            <p class="text-left">: <?= $h['LamaSewa']; ?></p>
            <p class="text-left">: <?= $h['TanggalAntar']; ?></p>
            <p class="text-left">: <?= $h['Venue']; ?></p>
            <p class="text-left">: <?= $h['AlamatVenue']; ?></p>
            <p class="text-left">: <?= $h['AlamatAntar'];?></p>
           
      </tr>
      <tr><th> <p class="text-left">Jumlah Unit</p></th>
        <th><p class="text-left"> <?= $h['JumlahUnit']; ?></a></p></th>
        <th>
          <p class="text-left">Harga Total </p>
      </th>
      <th> 
        <p class="text-left"><?= number_format($h['TotalDibayar'], 0,'.', '.');?></p>
          </th>
         </tr>
    </tr>
    </thead>
  </table>
  
<div class="col-md-12">
  <?php if($h['image1']!=''&&$h['image2']!=''&&$h['image3']!=''){
                                        
                                    }else{ echo '<div class="alert alert-warning text-center" role="alert">
Gambar hanya bisa diupload sekali!! dan tidak bisa dirubah guys</div>';}?>

  </div>
   <div class="col-sm-3">
                <img src="<?php echo base_url('assets/img/jadwal/').$h['image1']?>" class="img-thumbnail">
              </div> 
              <div class="col-sm-3">
                <img src="<?php echo base_url('assets/img/jadwal/').$h['image2'];?>" class="img-thumbnail">
              </div>  
              <div class="col-sm-3">
                <img src="<?php echo base_url('assets/img/jadwal/').$h['image3'];?>" class="img-thumbnail">
              </div>  
              <div class="col-sm-3">
                <img src="<?php echo base_url('assets/img/jadwal/').$h['image4']?>" class="img-thumbnail">
              </div>     
  
 </div> 
 <div class="col-md-12">
  <?php if($h['image1']!=''&&$h['image2']!=''&&$h['image3']!=''){
    echo '<p class="card-text badge"><small class="text-muted">Gambar diupload Tanggal: '.date('d F Y',$h['wektu']).' Jam '.date('H:i:s',$h['wektu']).'</small></p>';}else{ }?>
  </div>
 
 <?php if($h['image1']!=''&&$h['image2']!=''&&$h['image3']!=''){

              $day = date('l',$h['wektu']);
              $day2 = date('l',$h['wektu2']);
                $dayList = array(
                    'Sunday' => 'Minggu',
                    'Monday' => 'Senin',
                    'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis',
                    'Friday' => 'Jumat',
                    'Saturday' => 'Sabtu'
                );

                if($h['Statuse'] ==2){
                  echo '<div class="alert alert-primary" role="alert">
                        Unit Udeh dikantor boskuh dan Aman..! :)  Hari '.$dayList[$day2].' '. date('d F Y',$h['wektu2']).' Jam '.date('H:i:s',$h['wektu2']).
                      '</div>' ;
                }else{
                echo '<div class="alert alert-success" role="alert">
                        Udeh Terkirim guys..! :)  Hari '.$dayList[$day].' '. date('d F Y',$h['wektu']).' Jam '.date('H:i:s',$h['wektu']).
                      '</div>' ;
                    }
               }else{ echo '<div class="form-group mx-4">
            <div class="row">
              <div class="col-sm">
                <input type="file" class="custom-file-input" id="image1" name="image1" required>
               <label class="custom-file-label" for="image1">Pilih gambar guys</label>
                </div> 
              <div class="col-sm"><input type="file" class="custom-file-input" id="image2" name="image2" aria-describedby="inputGroupFileAddon01" required>
                  <label class="custom-file-label" for="image2">Pilih gambar guys</label>
                </div>
                 <div class="col-sm"><input type="file" class="custom-file-input" id="image3" name="image3" aria-describedby="inputGroupFileAddon01" required>
                  <label class="custom-file-label" for="image3">Pilih gambar guys</label>
                </div>
                 <div class="col-sm"><input type="file" class="custom-file-input" id="image4" name="image4" aria-describedby="inputGroupFileAddon01" required>
                  <label class="custom-file-label" for="image4">Pilih gambar guys</label>
                </div>
                        
              </div>
            </div>';}?>
         
 
                          <div class="modal-footer">
                                  <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                 <?php if($h['Statuse'] == 0){
                                          echo '<button type="submit" class="btn btn-primary">Unit Terkirim!</button>';
                                    }else{
                                      
                                      if($h['Statuse'] == 1){
                                         echo '<button type="submit" class="btn btn-success ">Unit Aman!</button>';
                                      } }?>
                                   
                                </div>
                                  </div>

                                  </div>
                              </div>
                            <?php echo form_close(); ?>
                            </div>
                            
                  </ul>
                </div>
              </div>
            </div><?php $i++; ?><?php endforeach;?>
          </div>
        </div>
                     