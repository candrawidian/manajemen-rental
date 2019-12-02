<div class="container">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
		 <?php if (validation_errors()):?>
                  <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                  </div>
              <?php endif; ?>

          		<?= form_error('jadwal','<div class="alert alert-danger" role="alert">', '</div>');?>
          		<?= $this->session->flashdata('message'); ?>
      
			<div class="container">
				
				<form class="user" method="post" action="">
					<div class="form-group row">
				    <label for="colFormLabelSm" class="col-form-label col-form-label-sm">No RFO</label>
				    <div class="col-sm-2">
				      <input type="text" class="form-control form-control-sm" id="noRFO" name="noRFO" value="<?= $b['noRFO'];?>"  placeholder="Masukkan No RFO.." readonly>
				    </div>
				    <label for="colFormLabelSm" class="col-form-label col-form-label-sm">No. SJ</label>
				    <div class="col-sm-2">
				      <input type="text" class="form-control form-control-sm" id="noSJ" name="noSJ" placeholder="Masukkan No SJ.." value="<?= $b['noSJ'];?>">
				    </div>
				  </div>
 			  </div>
					<div class="form-group row">
				    <label class="col-sm-2 col-form-label col-form-label-sm">Nama Pemesan</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="NamaPemesan" name="NamaPemesan" placeholder="Masukkan Nama Pemesan" value="<?= $b['NamaPemesan'];?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label class="col-sm-2 col-form-label col-form-label-sm">No. Tlp Pemesan</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="NoTlp" name="NoTlp" placeholder="Masukkan No. Telephone" value="<?= $b['NoTlp'];?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label class="col-sm-2 col-form-label col-form-label-sm">Email</label>
				    <div class="col-sm-4">
				      <input type="email" class="form-control form-control-sm" id="EmailEO" name="EmailEO" placeholder="Masukkan Email" value="<?= $b['EmailEO'];?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label class="col-sm-2 col-form-label col-form-label-sm">Nama EO/WO/Company</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="NamaEO" name="NamaEO"placeholder="Masukkan Nama EO/WO/Company"value="<?= $b['NamaEO'];?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label class="col-sm-2 col-form-label col-form-label-sm">Alamat EO/WO/Company</label>
				    <div class="col-sm-4">
				      <textarea type="text" class="form-control form-control-sm" id="AlamatWO" name="AlamatWO" placeholder="Masukkan Alamat EO/WO" value="<?= $b['AlamatWO'];?>"><?= $b['AlamatWO'];?></textarea>
				    </div>
				</div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Unit Yang Di Pesan</label>
				    <div class="col-sm-3">
				    	<!-- <script type="text/javascript">
					  document.getElementById('Orderan').value = "<?= $b['Orderan'];?>";
					</script> -->
				      <select class="custom-select custom-select-sm" value="<?= $b['Orderan'];?>" id="Orderan" name="Orderan" type="text" class="form-control form-control-sm" onfocus="startHarga()" onblur="akhirHarga()" id="unit" placeholder="Unit Yang Di Pesan">
				      	<option selected><?= $b['Orderan'];?></option>
					  <?php foreach ($ambilproduk as $ap) : ?>
					  <option value="<?= $ap['namaProduk']; ?>"><?= $ap['namaProduk']; ?></option>
					<?php endforeach; ?>
					</select>
					</select>
					
				    </div>
				    <label for="colFormLabelSm" class="col-sm-0 col-form-label col-form-label-sm">Jumlah Unit</label>
				    <div class="input-group col-sm-2">
				      <input type="text" class="form-control form-control-sm" placeholder="Jumlah" id='JumlahUnit' name="JumlahUnit" onfocus="startHitung()" onblur="akhirHitung()" value="<?= $b['JumlahUnit'];?>"> 
				      <div class="input-group-prepend">
		                  <div class="input-group-text"><small>Unit</small>
		                  </div>
		                </div>
				    </div>
				  </div>
				<div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Sewa</label>
		            <div class='input-group  col-sm-3'>
		                <input type='date' class="form-control form-control-sm" id='TanggalSewa' name="TanggalSewa"  placeholder="Tanggal Event Dimulai" value="<?= $b['TanggalSewa'];?>"> 
		                <div class="input-group-prepend">
		                  <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
		                </div>
		            </div>
		            <label for="colFormLabelSm" class="col-md-0 col-form-label col-form-label-sm">Lama Sewa</label>
				    <div class="input-group col-sm-2">
				      <input type="text" class="form-control form-control-sm" id="LamaSewa" name="LamaSewa" placeholder="Lama Hari" onfocus="startHitung()" onblur="akhirHitung()" value="<?= $b['LamaSewa'];?>">
				      <div class="input-group-prepend">
		                  <div class="input-group-text"><small>Hari</small>
		                  </div>
		                </div>
				    </div> 
		        </div>
		        <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Antar</label>
		            <div class='input-group  col-sm-3'>
		                <input type='date' class="form-control form-control-sm" id="TanggalAntar" name="TanggalAntar" placeholder="Masukkan Tanggal Antar" value="<?= $b['TanggalAntar'];?>">
		                <div class="input-group-prepend">
		                  <div class="input-group-text"><i class="fas fa-calendar-alt"></i>
		                  </div>
		                </div>
		            </div>
		        </div>
		        <div class="form-group row">
				    <label class="col-sm-2 col-form-label col-form-label-sm">Venue</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="Venue" name="Venue" placeholder="Masukkan Venue" value="<?= $b['Venue'];?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label class="col-sm-2 col-form-label col-form-label-sm">Alamat Venue</label>
				    <div class="col-sm-4">
				      <textarea type="text" id="AlamatVenue" name="AlamatVenue" class="form-control form-control-sm" placeholder="Masukkan Alamat Venue" value="<?= $b['AlamatVenue'];?>"><?= $b['AlamatVenue'];?></textarea>
				    </div>
				    <label class="col-sm-0 col-form-label col-form-label-sm">Alamat Antar</label>
				    <div class="col-sm-4">
				      <textarea type="text" id="AlamatAntar" name="AlamatAntar" class="form-control form-control-sm" placeholder="Masukkan Alamat Antar" value="<?= $b['AlamatAntar'];?>"><?= $b['AlamatAntar'];?></textarea>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Harga Per Unit</label>
				        
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input class="form-control form-control-sm" id="HargaPerUnit" placeholder="Harga Per Unit" type='text' name='HargaPerUnit' onfocus="startHarga()" onblur="akhirHarga()" value="<?= $b['HargaPerUnit'];?>"> 
				    </div>
				    <label class="col-md-2 col-form-label col-form-label-sm">Total Harga</label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input type="text" class="form-control form-control-sm" id="TotalHarga" name="TotalHarga" placeholder="Total Harga" onfocus="startTotal()" onblur="akhirTotal()" value="<?= $b['TotalHarga'];?>"> 
				    </div>
				</div>
				<div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Biaya Kirim</label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input class="form-control form-control-sm" type="text" class="form-control form-control-sm" id="BiayaKirim" name="BiayaKirim" placeholder="Biaya Kirim" onfocus="startTotal()" onblur="akhirTotal()" value="<?= $b['BiayaKirim'];?>"> 
					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Standby Operator</label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input type="text" id="StandByOperator" name="StandByOperator" class="form-control form-control-sm" placeholder="Jumlah" onfocus="startTotal()" onblur="akhirTotal()" id="angka5" value="<?= $b['StandByOperator'];?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Transportasi</label>
				   <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input class="form-control form-control-sm"  type="text" class="form-control form-control-sm" id="Transportasi" name="Transportasi" placeholder="Biaya Transport" onfocus="startTotal()" onblur="akhirTotal()" value="<?= $b['Transportasi'];?>"> 
					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Transportasi Lokal</label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input type="text"  class="form-control form-control-sm" placeholder="Biaya Transport Lokal" onfocus="startTotal()" onblur="akhirTotal()" id="TransportasiLokal" name="TransportasiLokal" value="<?= $b['TransportasiLokal'];?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Konsumsi</label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input class="form-control form-control-sm" type="text" class="form-control form-control-sm" id="Konsumsi" name="Konsumsi" placeholder="Biaya Konsumsi" onfocus="startTotal()" onblur="akhirTotal()" value="<?= $b['Konsumsi'];?>">
					</div>
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Akomodasi</label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input type="text" class="form-control form-control-sm" placeholder="Jumlah" onfocus="startTotal()" onblur="akhirTotal()" id="Akomodasi" name="Akomodasi" value="<?= $b['Akomodasi'];?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Total Yang Dibayar</label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				    <div class="input-group-text"><small>Rp</small></div>
				      <input class="form-control form-control-sm" type="text" class="form-control form-control-sm" id="TotalDibayar" name="TotalDibayar" placeholder="Total Dibayar" value="<?= $b['TotalDibayar'];?>"> 
					</div>
				</div>
				<div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Pengirim</label>
				    <div class="col-sm-2 input-group-prepend input-group-prepend-sm">
				      <select class="form-control form-control-sm" type="text" class="form-control form-control-sm" id="Personil" name="Personil" placeholder="Personil">
				      	<option selected><?= $b['Personil'];?></option>
				      <?php $ja=$this->db->query("SELECT nama FROM karyawan WHERE posisi='Operasional' AND is_active=1")->result_array();

				      	foreach ($ja as $j) : ?>
					  <option value="<?= $j['nama']; ?>"><?= $j['nama']; ?></option>
					<?php endforeach; ?>
					  </select>
					 </div>
				</div>
			    <button type="submit" class="btn btn-primary">Kirim</button><a class="btn btn-success ml-2" href="<?= base_url('admin/');?>" role="button">Close</a>
				</form>
			</div>
</div>

		<script type="text/javascript">

  function startHarga(){
  inter = setInterval("Isi()",1);
  }
  function Isi(){

 	var unit = document.getElementById("Orderan").value;
 	if("HandyTalky"===unit){document.getElementById("HargaPerUnit").value = "45000";}
  	<?php foreach ($ambilproduk as $ap){	
  		echo 'else if("'.$ap['namaProduk'].'"===unit){document.getElementById("HargaPerUnit").value = "'.$ap['HargaPerUnit'].'";}';					 
					} ?>
	else{document.getElementById("HargaPerUnit").value = 0;}
  	
  }

  function akhirHarga(){
      clearInterval(inter);
  }

  function startHitung(){
  interval = setInterval("hitung()",1);
  }
  
  function hitung(){
    var angka1 = parseInt(document.getElementById("JumlahUnit").value);
    var angka2 = parseInt(document.getElementById("LamaSewa").value);
    var angka3 = parseInt(document.getElementById("HargaPerUnit").value);
    var jumlah = angka2 * angka1 * angka3; 
    document.getElementById("TotalHarga").value = jumlah;
    
   }
     function akhirHitung(){
      clearInterval(interval);

  }

   function startTotal(){
  erval = setInterval("total()",1);
  }
  function total(){
  	var hasil = parseInt(document.getElementById("TotalHarga").value);
  var angka4 = parseInt(document.getElementById("BiayaKirim").value);
    var angka5 = parseInt(document.getElementById("StandByOperator").value);
    var angka6 = parseInt(document.getElementById("Transportasi").value);
    var angka7 = parseInt(document.getElementById("TransportasiLokal").value);
    var angka8 = parseInt(document.getElementById("Konsumsi").value);
    var angka9 = parseInt(document.getElementById("Akomodasi").value);
    var jumlah1 = hasil + angka4 + angka5 + angka6 + angka7 + angka8 + angka9;
    document.getElementById("TotalDibayar").value = jumlah1;
	}

	function akhirTotal(){
      clearInterval(erval);

  }
</script>