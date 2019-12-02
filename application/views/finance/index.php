 <div class="container-fluid">  
 <div class="col mb-4"> 
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                       <div class="row no-gutters align-items-center">
                        <div class="col-md-11">
                          <?php if (validation_errors()):?>
                  <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                  </div>
              <?php endif; ?>

              <?= form_error('jadwal','<div class="alert alert-danger" role="alert">', '</div>');?>
              <?= $this->session->flashdata('message'); ?>
                        </div>
                        <div class="col-md-3 mr-2 mb-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengeluaran</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  $this->db->select('(SELECT COUNT(nominal) FROM keuangan WHERE status="Pengeluaran") AS pemi');
                          $pemi = $this->db->get()->row()->pemi; echo $pemi; ?></div>
                        </div> 
                        <div class="col-md-3 mr-2 mb-2">
                         <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pengeluaran</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $this->db->select('(SELECT SUM(nominal) FROM keuangan WHERE status="Pengeluaran") AS pei');
                          $pei = $this->db->get()->row()->pei; echo 'Rp'.number_format($pei, 0,'.', '.').',-'; ?></div>
                         </div>
                         <div class="col-md-3 mr-2 mb-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pemasukan</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  $this->db->select('(SELECT COUNT(nominal) FROM keuangan WHERE status="Pemasukan") AS peng');
                          $peng = $this->db->get()->row()->peng; echo $peng; ?></div>
                        </div> 
                        <div class="col-md-2 mr-2 mb-2">
                         <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pemasukan</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $this->db->select('(SELECT SUM(nominal) FROM keuangan WHERE status="Pemasukan") AS pes');
                          $pes = $this->db->get()->row()->pes; echo 'Rp'.number_format($pes, 0,'.', '.').',-'; ?></div>
                         </div>
                      </div>
                  <div class="col-auto mr-2 mb-4 inline">

                        <form method="post">
                          
                                  <b>Dari Tanggal</b>
                                  <input type="date" id="tanggal_awal" value="<?= set_value('tanggal_awal');?>" name="tanggal_awal" size="16" placeholder="Masukkan tanggal awal.."/>                
                             
                                  <b>Sampai Tanggal</b>
                                  <input type="date" id="tanggal_akhir" value="<?= set_value('tanggal_akhir');?>" name="tanggal_akhir" size="16" placeholder="Masukkan tanggal_akhir.."  />
                                  <button type="submit" class="btn btn-outline-primary" name="pencarian" />Filter</button>
                                  <input type="reset" value="Reset" class="btn btn-outline-warning" />

                                  <?php if(isset($_POST['pencarian'])){
                                    
                                        $tgla = $_POST['tanggal_awal'];
                                        $tglr = $_POST['tanggal_akhir'];

                                        if($tglr!=''&&$tgla!=''){
                                          echo '<a href="'.base_url().'finance/print/'.$tgla.'/'.$tglr.'" class="btn btn-primary ml-5" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
                                          }else{
                                          echo '<a href="'.base_url().'finance/print/" class="btn btn-primary ml-5" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
                                        }
                                      }else{
                                          echo '<a href="'.base_url().'finance/print/" class="btn btn-primary ml-5"><i class="fa fa-print" target="_blank"></i> Cetak</a>';
                                        }
                                      
                                        
                                         ?>
                                  
                                  <a href="<?= base_url().'finance/export/';?>" class="btn btn-danger"><i class="fa fa-download"></i> Export</a>
                                
                      </form>
                    
                        </div>
                        <table class="table table-hover table-bordered text-right" id="fi">
                    <thead  class="thead-dark">
                      <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="jios">
                      <?php $i=1; ?><?php foreach ($keuangan as $k) : ?>
                      <tr>
                        <th class="text-center"><?= $i; ?></th>
                        <td class="text-left"><?= $k['judul']; ?></td>
                        <td> <center><?= date('d-m-Y',strtotime($k['tanggal'])); ?></center></td>

                        
                          <?php if($k['status']=="Pemasukan"){
                          echo '<td>'.$k['nominal'].'</td><td>0</td>';
                            }else{
                              echo '<td>0</td><td>'.$k['nominal'].'</td>';
                            } ?>
                        
                        <td><a href="" data-toggle="modal" data-target="#editdata<?=$k['id'];?>" class="badge badge-success">edit</a>
                            <a href="" class="badge badge-danger" data-toggle="modal" data-target="#hapusdata<?=$k['id'];?>">delete</a></td>
                      </tr><?php $i++; ?><?php endforeach; ?>
                      <tfoot class="thead-light">
                        <tr>
                          <th colspan="3">Jumlah</th>               
                          <th id="hasil"></th>
                          <th id="hasil1"></th>
                          <th><span>Selisih = </span><span id="hasl"></span></th>
                        </tr>
                      </tfoot>
                </tbody>
              </table>
              <script type="text/javascript">

                function rubah(angka){
                 var reverse = angka.toString().split('').reverse().join(''),
                 ribuan = reverse.match(/\d{1,3}/g);
                 ribuan = ribuan.join('.').split('').reverse().join('');
                 return ribuan;
               }

                            var sumHsl = 0;
                            var r = document.getElementById("fi").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
                            var q = r + 1;
                            for(var t = 1; t < q; t++)
                            {
                              sumHsl = sumHsl + parseInt(document.getElementById("fi").rows[t].cells[3].innerHTML);
                            }

                            document.getElementById("hasil").innerHTML = 'Rp ' +rubah(sumHsl)+',-';

                             var sumHsl1 = 0;
                            var r = document.getElementById("fi").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
                            var y = r + 1;
                            for(var t = 1; t < y; t++)
                            {
                              sumHsl1 = sumHsl1 + parseInt(document.getElementById("fi").rows[t].cells[4].innerHTML);
                            }
                            document.getElementById("hasil1").innerHTML = 'Rp ' +rubah(sumHsl1)+',-';

                            var hasl = sumHsl - sumHsl1;
                            document.getElementById("hasl").innerHTML = 'Rp ' +rubah(hasl)+',-';
              </script>          
              <div class="col-auto mr-2 mb-4 text-right"><a href="<?= base_url().'finance/tambahdata/';?>" class="btn btn-primary ml-5"><i class="fa fa-book"></i> Tambah Data</a></div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Edit -->
            <?php foreach ($keuangan as $k) : ?>
  <div class="modal fade" id="editdata<?=$k['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editdataModalLabel<?=$k['id'];?>" aria-hidden="true"> <form method="post" action="<?= base_url('finance/ubahdata'); ?>">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editdataModalLabel<?=$k['id'];?>">Attantion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="false">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group row">
                                      <label for="inputPassword" class="col-sm-3 col-form-label">Keterangan</label>
                                      <div class="col-sm-9">
                                        <input type="hidden" value="<?= $k['id']; ?>" class="form-control" id="id" name="id">
                                        <input type="text" value="<?= $k['judul']; ?>" class="form-control" id="judul" name="judul" placeholder="Edit Judul">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputPassword" class="col-sm-3 col-form-label">Tanggal</label>
                                      <div class="col-sm-9">
                                        <input type="date" value="<?= $k['tanggal']; ?>" class="form-control" id="tanggal" name="tanggal" placeholder="Edit Judul">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputPassword" class="col-sm-3 col-form-label">Status</label>
                                      <div class="col-sm-9">
                                        
            
                                            <div class="form-check">
                                          <input class="form-check-input" type="radio" name="status" id="status" value="Pemasukan" <?php if($k['status'] == "Pemasukan"){ echo 'checked';}?>>
                                          <label class="form-check-label">
                                            Pemasukan
                                          </label>
                                          <input class="form-check-input ml-4" type="radio" name="status" id="status" value="Pengeluaran" <?php if($k['status'] == "Pengeluaran"){ echo 'checked';}?>>
                                          <label class="form-check-label ml-5">
                                            Pengeluaran
                                          </label>
                                        </div>
                                     
                                        <!-- <input type="text" value="<?= $k['status']; ?>" class="form-control" id="status" name="status" placeholder="Edit Judul"> -->
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputPassword" class="col-sm-3 col-form-label">Nominal</label>
                                      <div class="col-sm-9">
                                        <input type="text" value="<?= $k['nominal']; ?>" class="form-control" id="nominal" name="nominal" placeholder="Edit Judul">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Ubah</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
<?php endforeach; ?>

<!-- Modal Hapus data -->

<?php foreach ($keuangan as $k) : ?>
  <div class="modal fade" id="hapusdata<?=$k['id'];?>" tabindex="-1" role="dialog" aria-labelledby="hapusdataModalLabel<?=$k['id'];?>" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="hapusdataModalLabel<?=$k['id'];?>">Attantion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="false">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Serius <?= $k['judul']; ?> ingin kamu hapus?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-primary" id="hapusdata" onclick="hapusdata(<?= $k['id'];?>)" href="" role="button">Hapus</a>
                                  </div>
                                </div>
                              </div>
                            </div>
<?php endforeach; ?>