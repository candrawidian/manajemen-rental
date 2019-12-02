<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
           <?php if (validation_errors()):?>
                  <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                  </div>
              <?php endif; ?>

          		<?= form_error('jadwal','<div class="alert alert-danger" role="alert">', '</div>');?>
          		<?= $this->session->flashdata('message'); ?>
              
   <div class="row">
     <?php foreach ($karyawan as $ky) : ?>  
   <div class="col-md-4 mb-4"> 
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                       <div class="row no-gutters align-items-center">
                    <div class="col-md-12 ">
                      <div class="card" style="width: 18rem;">
                          <img class="card-img-top" src="<?= base_url('assets/img/profile/').$ky['image']; ?>" height="250px">

                          <div class="card-body">
                            <h5 class="card-title"><?= $ky['nama']; ?></h5>
                            <p class="card-text">Posisi : <?php
                            $posi = array(
                                                          2 => 'Operational',
                                                          3 => 'Finance',
                                                          4 => 'Technician',
                                                      );


                             $g = $ky['posisi'];

                             echo $posi[$g] ?></p>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#editkaryawan<?=$ky['id'];?>">edit</a>
                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#karyawan<?=$ky['id'];?>">delete</a>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Modal -->
     <script type="text/javascript">
                                                  document.getElementById('is_active').value = "<?= $karyawan['is_active'];?>";
                                                </script>
    <?php foreach ($karyawan as $ky) : ?>
        <div class="modal fade" id="editkaryawan<?=$ky['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editkaryawanModalLabel<?=$ky['id'];?>" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editkaryawanModalLabel<?=$ky['id'];?>">Rincian Karyawan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="false">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="<?= base_url('admin/karyawan'); ?>" method="post">
                                        <div class="modal-body">
                                           <div class="form-group">
                                          <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= $ky['nama'];?>" readonly>
                                        </div>
                                           <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                              <div class="col-sm-8">
                                                <select class="form-control" type="text" id="jkl" name="jkl"  placeholder="Jenis Kelamin">
                                                  <option selected><?= $ky['jkl'];?></option>
                                                  <option value="Pria">Pria</option>
                                                  <option value="Wanita">Wanita</option>
                                                </select>
                                          </div>
                                           </div>
                                            <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                              <div class="col-sm-8">
                                            <input type="text" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Masukka Tanggal Lahir Anda" value="<?= $ky['tanggallahir'];?>">
                                           </div>
                                           </div>
                                           <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Tempat Lahir</label>
                                              <div class="col-sm-8">
                                            <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" placeholder="Masukkan Kota Kelahiran anda" value="<?= $ky['tempatlahir'];?>">
                                          </div>
                                           </div>
                                           <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Pendidikan</label>
                                              <div class="col-sm-8">
                                            <input type="text" class="form-control" id="pendidikan" name="pendidikan" placeholder="Masukkan Pendidikan Anda" value="<?= $ky['pendidikan'];?>">
                                            </div>
                                           </div>
                                         <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Jabatan</label>
                                              <div class="col-sm-8">
                                            <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Masukkan Jabatan" value="<?= $ky['posisi'];?>">
                                          </div>
                                           </div>
                                           <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Agama</label>
                                              <div class="col-sm-8">
                                            <input type="text" class="form-control" id="agama" name="agama" placeholder="Masukkan Agama" value="<?= $ky['agama'];?>">
                                          </div>
                                           </div>
                                           <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Alamat Sekarang</label>
                                              <div class="col-sm-8">
                                            <input type="text" class="form-control" id="alamatsekarang" name="alamatsekarang" placeholder="Ketik Alamat Anda" value="<?= $ky['alamatsekarang'];?>">
                                          </div>
                                           </div>
                                           <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Email</label>
                                              <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="<?= $ky['email'];?>" readonly>
                                          </div>
                                           </div>
                                            <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-4 col-form-label">Status</label>
                                              <div class="col-sm-8">
                                                <select class="custom-select" type="text" id="is_active" name="is_active" >
                                                  <option selected><?php if($ky['is_active']==1){
                                                      echo "Aktif";
                                                  }else{
                                                      echo "Tidak Aktif";
                                                  }?></option>
                                                  <option value="1">Aktif</option>
                                                  <option value="0">Tidak Aktif</option>
                                                </select>
                                              </div>
                                               
                                           </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                      </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach; ?>
                         
    <?php foreach ($karyawan as $ky) : ?>
        <div class="modal fade" id="karyawan<?=$ky['id'];?>" tabindex="-1" role="dialog" aria-labelledby="karyawanModalLabel<?=$ky['id'];?>" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="karyawanModalLabel<?=$ky['id'];?>">Rincian Pengiriman</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="false">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Serius ingin kamu hapus?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-primary" href="<?= base_url() . "admin/hapuskaryawan/" . $ky['id']; ?>" role="button">Hapus</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach; ?>
    