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
   <div class="col-md-12 mb-4"> 
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                       <div class="row no-gutters align-items-center">
                    <div class="col-md-12 ">          
          	
             <form method="post" id="keuangan">
          	<div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Keterangan</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				      <input type="text" class="form-control form-control-sm" id="judul" name='judul' placeholder="Masukkan Judul" value="<?= set_value('judul');?>">

					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tanggal</label>
				    <div class="col-sm-3 input-group-prepend input-group-prepend-sm">
				    
				     <input type="date" class="form-control form-control-sm" id="tanggal" name='tanggal' aria-describedby="emailHelp" placeholder="Masukkan Tanggal lahir" value="<?= set_value('tanggal');?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Status</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				      <div class="form-check">
					  <input class="form-check-input" type="radio" name="status" id="status" value="Pemasukan">
					  <label class="form-check-label">
					    Pemasukan
					  </label>
					  <input class="form-check-input ml-4" type="radio" name="status" id="status" value="Pengeluaran">
					  <label class="form-check-label ml-5">
					    Pengeluaran
					  </label>
					</div>
				</div>
			</div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nominal</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				      <input type="text" class="form-control form-control-sm" id="nominal" name='nominal' aria-describedby="emailHelp" placeholder="Masukkan Pendidikan" value="<?= set_value('nominal');?>">
					</div>
				  </div>
				  		   		
			 	<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</div>
			 </form>
		</div>
	</div>
</div>
</div>

          	</div>
          </div>
</div>
<div class="col-md-12 mb-4"> 
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                       <div class="row no-gutters align-items-center">
                    <div class="col-md-12 "> 
                    	<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
		                <thead  class="thead-dark">
		                  <tr>
		                    <th scope="col">No</th>
		                    <th scope="col">Judul</th>
		                    <th scope="col">Tanggal</th>
		                    <th scope="col">Pemasukan</th>
		                    <th scope="col">Pengeluaran</th>
		                    
		                    <th>Action</th>
		                  </tr>
		                </thead>
		                <tbody id="jios">
		                	<?php $i=1; ?><?php foreach ($keuangan as $k) : ?>
		                  <tr>
		                    <th><?= $i; ?></th>
		                    <td><?= $k['judul']; ?></td>
		                    <td><?= $k['tanggal']; ?></td>

		                    
		                    	<?php if($k['status']=="Pemasukan"){
		                    	echo '<td>'. number_format($k['nominal'], 0,'.', '.').'</td><td>-</td>';
		                    		}else{
		                    			echo '<td>-</td><td>'.number_format($k['nominal'], 0,'.', '.').'</td>';
		                    		} ?>
		                    
		                    <td><a href="" class="badge badge-success" data-toggle="modal" data-target="#editdata<?=$k['id'];?>">edit</a>
                            <a href="" class="badge badge-danger" data-toggle="modal" data-target="#hapusdata<?=$k['id'];?>">delete</a></td>
		                  </tr><?php $i++; ?><?php endforeach; ?>
		                  <tfoot class="thead-light">
		                  	<tr>
			                    <th colspan="3">Jumlah</th>			                    
			                    <th><?php $this->db->select('(SELECT SUM(nominal) FROM keuangan WHERE status="Pemasukan") AS pem');
                      $pem = $this->db->get()->row()->pem; 
                   echo 'Rp '.number_format($pem, 0,'.', '.').',-'; ?></th>
			                    <th><?php $this->db->select('(SELECT SUM(nominal) FROM keuangan WHERE status="Pengeluaran") AS peng');
                      $peng = $this->db->get()->row()->peng; 
                   echo 'Rp '.number_format($peng, 0,'.', '.').',-';?></th>
                   <th><?php $klr = $pem - $peng; echo 'Rp '.number_format($klr, 0,'.', '.').',-'; ?></th>
		                  	</tr>
		                  </tfoot>
		                  <!-- Modal Hapus -->

		                  <?php foreach ($keuangan as $k) : ?>
	<div class="modal fade" id="hapusdata<?=$k['id'];?>" tabindex="-1" role="dialog" aria-labelledby="hapusdataModalLabel<?=$k['id'];?>" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="hapusdataModalLabel<?=$k['id'];?>">Rincian</h5>
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

<!-- Modal Edit -->

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



