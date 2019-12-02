         <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <div class="col-lg-6">
             <?= $this->session->flashdata('message'); ?>
          </div>


          <div class="row">

           <div class="col mb-4"> 
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                       <div class="row no-gutters align-items-center">
                    <div class="col-md-6 mr-2 mb-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Orderan Bulan ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml-1; ?></div>
                    </div> <div class="col-md-4 mr-2 mb-2">
                     <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan Bulan Ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($TotalHarga, 0,'.', '.');?></div>
                     </div>
                  </div>
                  <div class="col-auto mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Target : <?= ($jml-1)*2;?>% dari 100%</div>
                   <div class="progress progress-sm mr-2 mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width:<?= ($jml-1)*2;?>%"></div>
                          </div>
                        </div>
                      
              <table class="table table-hover">
                <thead  class="thead-dark">
                  <tr>
                    <th scope="col">Unit</th>
                    <th scope="col">Total Order</th>
                    <th scope="col">Pendapatan</th>
                    <th scope="col">Target</th>
                  </tr>
                </thead>
                <tbody><?php foreach ($produk as $h) : ?>
                  <tr>
                    <th><?= $h['namaProduk']; ?></th>
                    <td><?php  $this->db->select('(SELECT COUNT(Orderan) FROM jadwal WHERE Orderan="'.$h['namaProduk'].'") AS ba');
                      $ba = $this->db->get()->row()->ba; 
                   echo $ba;
                    ?></td>
                    <td><?php  $this->db->select('(SELECT SUM(TotalHarga) FROM jadwal WHERE Orderan="'.$h['namaProduk'].'") AS ha');
                      $ha = $this->db->get()->row()->ha; 
                   echo number_format($ha, 0,'.', '.'); 
                    ?></td>
                    <td><div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width:<?= $ba;?>%"></div>
                          </div></td>
                  </tr><?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

            <!-- Pending Requests Card Example -->
              <!-- <div class="col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Cancel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
 -->
    
    <div class="row">
           <div class="col-md-7 mb-4"> 
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
              <table class="table table-hover">
                <thead  class="thead-dark">
                  <tr>
                    <th scope="col">Unit</th>
                    <th scope="col">Total Unit Handy</th>
                    <th scope="col">Unit Keluar</th>
                    <th scope="col">Stock Dikantor</th>
                  </tr>
                </thead>
                <tbody><?php foreach ($produk as $h) : ?>
                  <tr>
                    <th><?= $h['namaProduk']; ?></th>
                    <td><?= $h['JumlahUnit']; ?></td>
                    <td><?php  $this->db->select('(SELECT SUM(JumlahUnit) FROM jadwal WHERE Orderan="'.$h['namaProduk'].'") AS has');
                      $has = $this->db->get()->row()->has; 
                   echo $has; 
                    ?></td>
                    <td><?= $h['JumlahUnit']-$has; ?></td>
                  </tr><?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <div class="col-md-5 mb-4"> 
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
              <table class="table table-hover">
                <thead  class="thead-dark">
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama Personil</th>
                    <th scope="col">Jumlah Antaran</th>
                    <th scope="col">Performa</th>
                  </tr>
                </thead>
                <tbody><?php 
                 $hasile=$this->db->query("SELECT DISTINCT Personil FROM jadwal")->result_array();
                foreach ($hasile as $c):?>
                  <tr>
                    <th scope="row"></th>
                    <td><?= $c['Personil']; ?></td>
                    <td><?php $this->db->select('(SELECT COUNT(Personil) FROM jadwal WHERE Personil="'.$c['Personil'].'") AS hasi');
                      $hasi = $this->db->get()->row()->hasi; 
                   echo $hasi; ?></td>
                    <td>
                      <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width:<?= $hasi*10;?>%"></div>
                          </div>
                    </td>
                  </tr><?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
        <!-- Content Row -->
<!-- 
          <div class="row"> -->

            <!-- Area Chart -->
           <!--  <div class="col-xl-8 col-lg-7">
              <div class="card border-left-primary shadow mb-4"> -->
                <!-- Card Header - Dropdown -->
                <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pendapatan</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div> -->
                <!-- Card Body -->
               <!--  <div class="card-body">
                  <div class="chart-area">
                    <canvas id="Chartku" width="300" height="100" ></canvas>
                  </div>
                </div>
               </div>
            </div> -->

            <!-- Pie Chart -->
            <!-- <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4"> -->
                <!-- Card Header - Dropdown -->
                <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div> -->
                <!-- Card Body -->
                <!-- <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div> -->
          
           <!-- Content Row -->
      <div class="col mb-4">
               <div class="card border-left-primary shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Jadwal Pengiriman</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No RFO</th>
                      <th>Nama</th>
                      <th>Tanggal Antar</th>
                      <th>Venue</th>
                      <th>Unit</th>
                      <th>Jumlah</th>
                      <th>Pengirim</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>No RFO</th>
                      <th>Nama</th>
                      <th>Tanggal Antar</th>
                      <th>Venue</th>
                      <th>Unit</th>
                      <th>Jumlah</th>
                      <th>Pengirim</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $i=1; ?>
                      <?php foreach ($data as $h) :?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $h['noRFO']; ?></td>
                        <td><?= $h['NamaPemesan']; ?></td>
                        <td><?= $h['TanggalAntar']; ?></td>
                        <td><?= $h['Venue']; ?></td>
                        <td><?= $h['Orderan']; ?></td>
                        <td><?= $h['JumlahUnit']; ?></td>
                        <td><?= $h['Personil']; ?></td>
                        <td>
                            <a href="<?= base_url('admin/editjadwal/'.$h['noRFO']);?>" class="badge badge-success">edit</a>
                            <a href="" class="badge badge-danger" data-toggle="modal" data-target="#hapusjadwal<?=$h['noRFO'];?>">delete</a>
                            <div class="modal fade" id="hapusjadwal<?=$h['noRFO'];?>" tabindex="-1" role="dialog" aria-labelledby="hapusjadwalModalLabel<?=$h['noRFO'];?>" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="hapusjadwalModalLabel<?=$h['noRFO'];?>">Rincian Pengiriman</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="false">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Serius ingin kamu hapus?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-primary" href="<?= base_url() . "admin/hapusjadwal/" . $h['noRFO']; ?>" role="button">Hapus</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <a href="<?=$h['noRFO'];?>" class="badge badge-info" data-toggle="modal" data-target="#detailjadwal<?=$h['noRFO'];?>">detail</a>
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
    <div class="row  p-3 mb-2 bg-light text-dark">
      <div class="col-4">
        <p class="text-left"><img src="https://momototoy.com/wp-content/uploads/2019/06/LOGO-BARU.png" class="rounded-sm-2 float-left pb-3" alt="..." width="70%"></p>
      </div>
    </div>
        <div class="row">
          <div class="col-6">
        <p class="text-left">Head Office</p>
        <p class="text-left">Jl. Pegangsaan Barat no.24 Menteng Jakarta Pusat, 10310</p>
        <p class="text-left">Phone/WA : +6287776000047  & +6281280253545</p>
        <p class="text-left">Email : thero@momototoy.com</p>
      </div>
    </div>
    <hr class="sidebar-divider">
   
      <div class="row">
          <div class="col-md-3"><p class="text-left badge badge-success">No RFO : <?= $h['noRFO']; ?></p></div>
          <div class="col-md-6"><p class="text-left badge badge-success">No SJ : <?= $h['noSJ']; ?></p></div>
        </div>
   
    <div class="row">
      <div class="col-sm-9">
        <div class="row">
          <div class="col-5 col-sm-4">
            <p class="text-left">Nama Pemesan </p>
            <p class="text-left">No Telp Pemesan</p>
            <p class="text-left">Email </p>
            <p class="text-left">Nama EO/WO/Company </p>
            <p class="text-left">Alamat EO/WO/Company </p>
          </div>
          <div class="col-7 col-sm-6">
            <p class="text-left">: <?= $h['NamaPemesan']; ?></p>
            <p class="text-left">: <?= $h['NoTlp']; ?></p>
            <p class="text-left">: <?= $h['EmailEO']; ?></p>
            <p class="text-left">: <?= $h['NamaEO']; ?></p>
            <p class="text-left">: <?= $h['AlamatWO']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <table class="table table-bordered">
  <thead>
    <tr class="table-active">
      <th scope="col">No.</th>
      <th scope="col">Rincian Detail</th>
      <th scope="col">Rincian Harga</th>
      <th scope="col">Pengirim</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td>
        <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Unit Yang Di Pesan <span class="align-middle">:</span><span class="float-right"> <?= $h['Orderan']; ?></span></li>
                                    <li class="list-group-item">Jumlah Unit<span class="text-center">:</span><span class="float-right"><?= $h['JumlahUnit']; ?> Unit</span></li>
                                    <li class="list-group-item">Tanggal Sewa <span class="text-center">:</span><span class="float-right"><?= $h['TanggalSewa']; ?></span></li>
                                    <li class="list-group-item">Lama Sewa<span class="text-center">:</span><span class="float-right"><?= $h['LamaSewa']; ?> Hari</span></li>
                                    <li class="list-group-item">Tanggal Antar<span class="text-center">:</span><span class="float-right"><?= $h['TanggalAntar']; ?></span></li>
                                    <li class="list-group-item">Venue<span class="text-center">:</span><span class="float-right"><?= $h['Venue']; ?></span></li>
                                    <li class="list-group-item">Alamat Venue <span class="text-center">:</span><span class="float-right"> <?= $h['AlamatVenue']; ?></span></li>
                                    <li class="list-group-item">Alamat Antar<span class="text-center">:</span><span class="float-right"><?= $h['AlamatAntar']; ?></span></li>
                                   </ul>
                                </td>
                                <td>
                                  <ul class="list-group list-group-flush">
                                  <li class="list-group-item">Harga Per Unit : <span class="float-right">Rp <?= number_format($h['HargaPerUnit'], 0,'.', '.'); ?></span></li>
                                  <li class="list-group-item">Total Harga : <span class="float-right">Rp <?= number_format($h['TotalHarga'], 0,'.', '.'); ?></span></li>
                                    <li class="list-group-item">Biaya Kirim :<span class="float-right"> Rp <?= number_format($h['BiayaKirim'], 0,'.', '.'); ?></span></li>
                                    <li class="list-group-item">StandBy Operator : <span class="float-right"> Rp <?= number_format($h['StandByOperator'], 0,'.', '.'); ?></span></li>
                                    <li class="list-group-item">Transportasi : <span class="float-right"> Rp <?= number_format($h['Transportasi'], 0,'.', '.'); ?></span></li>
                                    <li class="list-group-item">Transportasi Lokal : <span class="float-right"> Rp <?= number_format($h['TransportasiLokal'], 0,'.', '.'); ?></span></li>
                                    <li class="list-group-item">Konsumsi : <span class="float-right"> Rp <?=  number_format($h['Konsumsi'], 0,'.', '.'); ?></span></li>
                                    <li class="list-group-item">Akomodasi : <span class="float-right">Rp <?= number_format($h['Akomodasi'], 0,'.', '.'); ?></span></li>                              
                                  </ul>
                                  </td>
                                <td>
                                  <ul class="list-group list-group-flush">
                                     <li class="list-group-item"><span class="text-center"><?= $h['Personil']; ?></span></li>
                                  </ul>
                                  </td>
                              </tr>
                               <tr class="table-info">
                                <th scope="row" colspan="2">Total Yang Dibayar :</th>
                                <td><span class="float-right">Rp <?= number_format($h['TotalDibayar'], 0,'.', '.'); ?></span></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <a href="<?= base_url().'admin/print/'.$h['noRFO'];?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                                  <a href="<?= base_url().'admin/export/'.$h['noRFO'];?>" class="btn btn-danger" target="_blank"><i class="fa fa-download"></i> Export</a>
                                </div>
                                  </div>

                                  </div>
                              </div>
                            </div>
                          </td>
                      </tr>
                      <?php $i++; ?>
                      <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

           </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>

      <!-- End of Main Content -->

        