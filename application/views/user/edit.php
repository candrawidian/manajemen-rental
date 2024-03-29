 <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> <?= $user['name'];?></h1>

          <div class="row">
          	<div class="col-lg-8">
          		<?= form_open_multipart('user/edit');?>
          		 <div class="form-group">
				    <label for="email">Email address</label>
				    <input type="email" class="form-control" id="email" name='email' aria-describedby="emailHelp" placeholder="Enter email" value="<?= $user['email'];?>" readonly>
				   <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				  </div>
				   <div class="form-group">
				    <label for="name">Nama</label>
				    <input type="text" class="form-control" id="name" name='name' placeholder="Ubah Nama" value="<?= $user['name'];?>"><?= form_error('name','<small class="text-danger pl-3">','</small>');?>   
				    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				  </div>
				   <div class="form-group">
				   	<div class="col-sm-10">Picture</div>
				   	<div class="row">
				   		<div class="col-sm-3">
				   			<img src="<?= base_url('assets/img/profile/').$user['image']; ?>" class="img-thumbnail">
				   		</div>				   		
				   		<div class="col-sm-9">
				   			 <div class="custom-file">
							    <input type="file" class="custom-file-input" id="image" name='image' aria-describedby="inputGroupFileAddon01">
							    <label class="custom-file-label" for="image">Choose file</label>
							  </div>
							</div>
				   		</div>
				   	</div>
				   	<div class="form-group row justify-content-center">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">edit</button>
					</div>
				</div>
			</form>
				</div>
          	</div>
          </div>

  </div>