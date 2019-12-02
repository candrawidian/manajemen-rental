

         <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
          	
          	<div class="col-lg">
              <?php if (validation_errors()) :?>
                  <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                  </div>
              <?php endif; ?>

          		<?= form_error('menu','<div class="alert alert-danger" role="alert">', '</div>');?>
          		<?= $this->session->flashdata('message'); ?>

          		<a href="" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#newSubMenuModal">Add New SubMenu</a>
          		<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Title</th>
				      <th scope="col">Menu</th>
              <th scope="col">Url</th>
              <th scope="col">Icon</th>
              <th scope="col">Active</th>
              <th scope="col">Action</th>          
				    </tr>
				  </thead>
				  <tbody>
				  	<?php $i=1; ?>
				  	<?php foreach ($submenu as $sm) :?>
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= $sm['title']; ?></td>
              <td><?= $sm['menu']; ?></td>
              <td><?= $sm['url']; ?></td>
              <td><?= $sm['icon']; ?></td>
              <td><?= $sm['is_active']; ?></td>
				      <td>
				      		<a href="" data-toggle="modal" class="badge badge-success" data-target="#editmenu<?=$sm['id'];?>" class="badge badge-success">edit</a>
				      		<a href="" class="badge badge-danger">delete</a>

				      </td>
				    </tr>
				    <?php $i++; ?>
				    <?php endforeach; ?>
				  </tbody>
				</table>
          	</div>

          </div>  

        </div>
        <!-- /.container-fluid -->

      <!-- End of Main Content -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Add New SubMenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="post">
      <div class="modal-body">
         <div class="form-group">
		    <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
		  </div>
      <div class="form-group">
        <select name="menu_id" id="menu_id" class="form-control">
          <option value="">Select Menu</option>
          <?php foreach ($menu as $m) :?>
            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
         <div class="form-group">
          <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
         </div>
          <div class="form-group">
          <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
         </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
              <label class="form-check-label" for="is_active">
                Active?
              </label>
            </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
  	</form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
            <?php foreach ($submenu as $sm) : ?>
  <div class="modal fade" id="editmenu<?=$sm['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editmenuModalLabel<?=$sm['id'];?>" aria-hidden="true"> <form method="post" action="<?= base_url('menu/editmenu'); ?>">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editmenuModalLabel<?=$sm['id'];?>">Attantion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="false">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group row">
                                      <label for="inputPassword" class="col-sm-3 col-form-label">Nama</label>
                                      <div class="col-sm-9">
                                        <input type="hidden" value="<?= $sm['id']; ?>" class="form-control" id="id" name="id">
                                        <input type="text" value="<?= $sm['title']; ?>" class="form-control" id="title" name="title" placeholder="Edit Title">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputPassword" class="col-sm-3 col-form-label">URL</label>
                                      <div class="col-sm-9">
                                        <input type="text" value="<?= $sm['url']; ?>" class="form-control" id="url" name="url" placeholder="Edit URL">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputPassword" class="col-sm-3 col-form-label">Letak Menu</label>
                                      <div class="col-sm-9">
                                        
                                          <select name="menu_id" id="menu_id" class="form-control">
                                        <option value="">Select Menu</option>
                                        <?php foreach ($menu as $m) :?>
                                          <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                     
                                        <!-- <input type="text" value="<?= $k['status']; ?>" class="form-control" id="status" name="status" placeholder="Edit Judul"> -->
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputPassword" class="col-sm-3 col-form-label">Icon</label>
                                      <div class="col-sm-9">
                                        <input type="text" value="<?= $sm['icon']; ?>" class="form-control" id="icon" name="icon" placeholder="Edit Judul">
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
      