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
          	<?= form_open_multipart('admin/tambahkaryawan');?>

          	<div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				      <input type="text" class="form-control form-control-sm" id="nama" name='nama' aria-describedby="emailHelp" placeholder="Masukkan Nama" value="<?= set_value('nama');?>">

					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Lahir</label>
				    <div class="col-sm-3 input-group-prepend input-group-prepend-sm">
				    
				     <input type="date" class="form-control form-control-sm" id="tanggallahir" name='tanggallahir' aria-describedby="emailHelp" placeholder="Masukkan Tanggal lahir" value="<?= set_value('tanggallahir');?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Jenis Kelamin</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				      <div class="form-check">
					  <input class="form-check-input" type="radio" name="jkl" id="jkl" value="Pria">
					  <label class="form-check-label" for="exampleRadios1">
					    Laki-laki
					  </label>
					  <input class="form-check-input ml-4" type="radio" name="jkl" id="jkl" value="Wanita">
					  <label class="form-check-label ml-5" for="exampleRadios1">
					    Perempuan
					  </label>
					</div>
				      
					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"></label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Pendidikan</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				      <input type="text" class="form-control form-control-sm" id="pendidikan" name='pendidikan' aria-describedby="emailHelp" placeholder="Masukkan Pendidikan" value="<?= set_value('pendidikan');?>">
					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tempat Lahir</label>
				    <div class="col-sm-3 input-group-prepend input-group-prepend-sm">
				    
				     <input type="text" class="form-control form-control-sm" id="tempatlahir" name='tempatlahir' aria-describedby="emailHelp" placeholder="Masukkan Tempat Lahir" value="<?= set_value('tempatlahir');?>">
				    </div>
				  </div>
				   <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Alamat Sekarang</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				     <input type="text" class="form-control form-control-sm" id="alamatsekarang" name='alamatsekarang' aria-describedby="emailHelp" placeholder="Tulis Alamat" value="<?= set_value('alamatsekarang');?>">
					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Agama</label>
				    <div class="col-sm-3 input-group-prepend input-group-prepend-sm">
				    
				     <input type="text" class="form-control form-control-sm" id="agama" name='agama' aria-describedby="emailHelp" placeholder="Masukkan Agama" value="<?= set_value('agama');?>">
				    </div>
				  </div>
				   <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Posisi</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				     <select class="custom-select custom-select-sm" id="posisi" name='posisi' value="<?= set_value('posisi');?>">
						  <option selected>Pilih Jabatan</option>
						  <option value="2">Operasional</option>
						  <option value="3">Finance</option>
						  <option value="4">Technician</option>
						 </select> 
					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
				    <div class="col-sm-3 input-group-prepend input-group-prepend-sm">
				    
				     <input type="text" class="form-control form-control-sm" id="email" name='email' aria-describedby="emailHelp" placeholder="Enter email" value="<?= set_value('email');?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Upload Foto</label>
				    <div class="col-sm-4 input-group-prepend input-group-prepend-sm">
				    
				     
							    <input type="file" class="custom-file-input" id="image" name='image' aria-describedby="inputGroupFileAddon01" value="<?= set_value('image');?>">
							    <label class="custom-file-label" for="image">Choose file</label>
							
					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
				    <div class="col-sm-3 input-group-prepend input-group-prepend-sm">
				    
				     <input type="Password" class="form-control form-control-sm" id="password" name='password' aria-describedby="emailHelp" placeholder="Enter Password">
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
</div></div>

