<!DOCTYPE html>
<html>
<head>
	<style>
 @page 
        {
            size: auto;   /* auto is the current printer page size */
            margin: 5mm;  /* this affects the margin in the printer settings */

        }

        body 
        {
            background-color:#FFFFFF; 
            margin: 0px;  /* the margin on the content before printing */

       }

#fi {
    border-collapse: collapse;
    width: 700px;
    border: 1px solid #000;
}

#fi tr th{
	width: 350px 100px;
    font-weight: bold;
}

#fi, th, td {
    padding: 8px 20px;
    text-align: center;
    border: 1px solid #000;
}

#fi tr:hover {
    background-color: #f5f5f5;
}

#di {
    border-collapse: collapse;
    width: 700px;
    border: 1px solid #000;
}

#di tr th{
	width: 350px 100px;
    font-weight: bold;
}

#di, th, td {
    padding: 8px 20px;
    text-align: center;
    border: 1px solid #000;
}

#di tr:hover {
    background-color: #f5f5f5;
}

</style>
</head>
<body>

	<center><h1>Laporan Keuangan</h1></center>
	<?php $awal =  $this->uri->segment(3);
		$akhir = $this->uri->segment(4);?>
		<?php if($awal!=''&& $akhir!=''){
			echo "<center><h5>Periode ".$awal." Sampai ".$akhir."</h5></center>";
		} ?>
	
	<center><h3>Laporan Pemasukan</h3></center>
	<center><table id="fi">
		<thead>
			<tr>
				<th width="20px">No</th>
				<th>Keterangan</th>
				<th width="130px">Tanggal</th>
				<th width="100px">Nominal</th>
			</tr>
		</thead>
		<tbody><?php $jumlah1 = array(); $i=1; ?>
			<?php foreach ($masuk as $k) : ?>
			<tr>
				<td><?= $i; ?></td>
				<td style="text-align: left;"><?= $k['judul']; ?></td>
				<td><?php $dayList = array(               'Sunday' => 'Minggu',
                                                          'Monday' => 'Senin',
                                                          'Tuesday' => 'Selasa',
                                                          'Wednesday' => 'Rabu',
                                                          'Thursday' => 'Kamis',
                                                          'Friday' => 'Jumat',
                                                          'Saturday' => 'Sabtu'
                                                      );

                 $l = date('l', strtotime($k['tanggal']));
				 
				 echo $dayList[$l].", ".date('d-m-Y', strtotime($k['tanggal']));
				  ?></td>


				<td style="text-align: right;"><?= 'Rp '.number_format($k['nominal'], 0,'.', '.').',-'; ?></td>
			</tr><?php $i++; ?>
			<?php $jumlah1[] = $k['nominal']; ?>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3"  style="text-align: right;">Jumlah</th>
				<th style="text-align: right;">
					<?php $j = array_sum($jumlah1);
					echo 'Rp '.number_format($j, 0,'.', '.').',-';?>
				</th>
			</tr>
		</tfoot>
	</table></center>
	<center><h3>Laporan Pengeluaran</h3></center>
	<center><table id="di">
		<thead>
			<tr>
				<th width="20px">No</th>
				<th>Keterangan</th>
				<th width="130px">Tanggal</th>
				<th width="100px">Nominal</th>
			</tr>
		</thead>
		<tbody><?php $jumlah = array(); $i=1; ?>
			<?php foreach ($keluar as $l) : ?>
			<tr>
				<td><?= $i; ?></td>
				<td  style="text-align: left;"><?= $l['judul']; ?></td>
				<td><?php $dayList = array(               'Sunday' => 'Minggu',
                                                          'Monday' => 'Senin',
                                                          'Tuesday' => 'Selasa',
                                                          'Wednesday' => 'Rabu',
                                                          'Thursday' => 'Kamis',
                                                          'Friday' => 'Jumat',
                                                          'Saturday' => 'Sabtu'
                                                      );

                 $o = date('l', strtotime($l['tanggal']));
				 
				 echo $dayList[$o].", ".date('d-m-Y', strtotime($l['tanggal']));
				  ?></td>
				<td style="text-align: right;"><?= 'Rp '.number_format($l['nominal'], 0,'.', '.').',-';?></td>
			</tr><?php $i++; ?>
			<?php $jumlah[] = $l['nominal']; ?>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3" style="text-align: right;">Jumlah</th>
				<th style="text-align: right;"><?php $a  = array_sum($jumlah);
				 echo 'Rp '.number_format($a, 0,'.', '.').',-'; ?></th>
			</tr>
		</tfoot>
	</table></center>
	<script type="text/javascript">

  window.print();

</script>
</body>
</html>