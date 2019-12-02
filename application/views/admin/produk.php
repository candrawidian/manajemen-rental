 <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <div class="col-lg-6">
             <?= $this->session->flashdata('message'); ?>
          </div>

          <div class="row">
          	<?php foreach ($produk as $b) :?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto mr-2">
                      <div class="text-xl font-weight-bold text-primary text-uppercase mb-1"><?= $b['namaProduk']; ?></div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $b['JumlahUnit']; ?> Unit</div><span class="p mb-0 font-weight-bold text-gray-600">Rp <?= number_format($b['HargaPerUnit'], 0,'.', '.');?>/Hari</span>
                    </div>
                    <div class="col-2 ml-2">
                      <a href="" class="btn btn-primary editproduk mb-2" data-toggle="modal" data-target="#editproduk<?=$b['id'];?>" data-id="<?= $b['id']; ?>">edit</a><a href="" class="btn btn-danger hapusproduk" data-toggle="modal" data-target="#hapusproduk<?=$b['id'];?>" data-id="<?= $b['id']; ?>">hapus</a>
                    </div>

                </div>
              </div>
            </div>
        </div>
        <?php endforeach; ?>
      </div>

      <?php foreach ($produk as $b): ?>
      <div class="modal" tabindex="-1" role="dialog" id="hapusproduk<?=$b['id'];?>" aria-labelledby="hapusprodukModalLabel<?=$b['id'];?>" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Hapus Produk <?= $b['namaProduk'] ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p>Ciyus <?= $b['namaProduk'] ?> mau di hapusss???</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <a class="btn btn-primary" href="<?= base_url() . "admin/hapusproduk/" . $b['id']; ?>">Save changes</a>
		      </div>
		    </div>
		  </div>
		</div>
	<?php endforeach; ?>

      <?php foreach ($produk as $b): ?>
      	<div class="modal fade" id="editproduk<?=$b['id'];?>" role="dialog" aria-labelledby="editprodukModalLabel<?=$b['id'];?>" aria-hidden="true" tabindex="-1">                    
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="editprodukModalLabel<?=$b['id'];?>">Edit Produk</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      <form method="post" action="<?= base_url() . "admin/editproduk/"; ?>">
					        <div class="form-group row">
							    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Unit</label>
							    <div class="col mb-4">
							    	 <input type="hidden" id="id" name="id" value="<?= $b['id'];?>" >
							      <input type="text" class="form-control col-xl-8" placeholder="Masukkan Nama Produk..."  id="namaProdukedit" name="namaProdukedit" value="<?= $b['namaProduk'];?>" required><?= form_error('namaProduk','<small class="text-danger pl-3">','</small>');?>
							    </div>
							  </div>
							   <div class="form-group row">
							    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Per Unit</label>
							    <div class="col mb-4">
							     <input type="text" class="form-control col-xl-8" placeholder="Masukkan Nama Produk..."  id="HargaPerUnitedit" name="HargaPerUnitedit" value="<?= $b['HargaPerUnit'];?>" required><?= form_error('HargaPerUnit','<small class="text-danger pl-3">','</small>');?>
							    </div>
							  </div>
							  <div class="form-group row">
		                       <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Unit</label>
		                      <div class="col">
							      <input type="text" class="form-control col-xl-8" placeholder="Masukkan Jumlah Unit..."  id="JumlahUnitedit" name="JumlahUnitedit" value="<?= $b['JumlahUnit'];?>" required><?= form_error('namaProduk','<small class="text-danger pl-3">','</small>');?>        
							    </div>
							</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary" type="button">Save changes</button>
					      </div>
					  </form>
					    </div>
					  </div> 
					</div>
            <?php endforeach; ?>

           <form class="user" method="post" action="<?= base_url() . "admin/produk/"; ?>">
           	<div class="row">
           <div class="col-xl-10 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-4">Tambah Produk</div>
                       <div class="form-group row">
					    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Unit</label>
					    <div class="col mb-4">
					      <input type="text" class="form-control col-xl-8" placeholder="Masukkan Nama Produk..."  id="namaProduk" name="namaProduk" value="<?= set_value('namaProduk');?>" ><?= form_error('namaProduk','<small class="text-danger pl-3">','</small>');?>
					    </div>
					  </div>
					  <div class="form-group row">
                       <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Per Unit</label>
                      <div class="col">
					      <input type="text" class="form-control col-xl-8" placeholder="Masukkan Harga Per Unit..."  id="HargaPerUnit" name="HargaPerUnit" value="<?= set_value('HargaPerUnit');?>" ><?= form_error('HargaPerUnit','<small class="text-danger pl-3">','</small>');?>
					    </div>
					</div>
					<div class="form-group row">
                       <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Unit</label>
                      <div class="col">
					      <input type="text" class="form-control col-xl-8" placeholder="Masukkan Jumlah Unit..."  id="JumlahUnit" name="JumlahUnit" value="<?= set_value('JumlahUnit');?>" ><?= form_error('JumlahUnit','<small class="text-danger pl-3">','</small>');?>
					    </div>
					</div>
                    </div>
                   </div>
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
              </div>
            </div>
        </div>

        </form>
           
</div>