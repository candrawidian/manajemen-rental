<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
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
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body style="width: 1000px; padding-left: auto;">
<table style="border:none;">
  <tr style="border:none;">
    <td style="border:none;"><img src="https://momototoy.com/wp-content/uploads/2019/06/LOGO.png" style="width:200px"></td><td rowspan="2" style="border:none; width: 600px; text-align: center;"><h1>SURAT JALAN</h1></td>
  </tr>
  <tr style="border:none;">
    <td style="border:none;">Jl. Pegangsaan Barat No.24</td>
  </tr>
  <tr style="border:none;">
    <td style="border:none;">Menteng - Jakarta Pusat</td>
    <td style="border:none; width: 400px; text-align: center;">NO:____856___/MC-SJ/XI/2019</td>
  </tr>
  <tr style="border:none;">
    <td style="border:none;">Ph. 0877-7600-0047 , 0812-8025-3534</td>
  </tr>
</table>

<hr>

<table style="border:none;width: 100%">
  <tr style="border:none;">
    <td style="border:none;">Kepada YTH</td>
  </tr>
  <tr style="border:none;">
    <td style="border:none;">Nama</td>
    <td style="border:none;">: <?= $h['NamaPemesan']; ?></td>
  </tr>
  <tr style="border:none;">
    <td style="border:none;">No. Tlp</td>
    <td style="border:none;">: <?= $h['NoTlp']; ?></td>
  </tr>
  <tr style="">
    <td style="border:none;">Alamat Kirim</td>
    <td style="border:none;">: <?= $h['AlamatAntar'] ?></td>
     <td style="border:none;width: 700px; text-align: center;"> Jam______  Janjian______   WIB</td>
  </tr>
</table>

<table style="width:100%">
  <tr>
    <th style="border-right: none;">Item</th>
    <th style="border-right: none; border-left: none;"></th>
    <th style="border-left: none;">Keterangan</th>
    <th style="border-right: none;">Penerima</th> 
    <th style="border-right: none; border-left: none;">QTY</th>
    <th style="border-left: none;">Keterangan</th>
    
  </tr>
  <tr style="border-right: none;">
    <td style="border-right: none;">
    	<ul style="list-style-type:none;">
    		<li>Base Station</li>
    		<li>Headset + Beltpack</li>
    		<li>Antena</li>
    		<li>Power Supply</li>
    		<li>Batery Backup</li>
    		<li>Charger Clearcom</li>
    		<li>Headset Remote Eartec</li>
    		<li>Hub + Power Supply</li>
    		<li>Battery Backup</li>
    	</ul>
    </td>
    <td style="border: none;">
    	<ul style="list-style-type:none;">
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    	</ul>
    </td>
     <td style="border-left: none;">
     	<ul style="list-style-type:none; text-align: center;">
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     	</ul>
     </td>
    <td style="border-right: none;">
    	<ul style="list-style-type:none;">
     		<li>Charger Eartec</li>
     		<li>Headset Master Eartec</li>
     		<li>HT ICOM V80 + Antena</li>
     		<li>Hansfree</li>
     		<li>Batery Cadangan</li>
     		<li>Tas</li>
     		<li>Charger HT</li>
     		<li>Megaphone</li>
     		<li>Batery Cadangan TOA</li>
     	</ul>
    </td>
     <td style="border: none;">
     	<ul style="list-style-type:none;">
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    		<li>0</li>
    	</ul>
     </td>
     <td style="border-left: none;">
     	<ul style="list-style-type:none;">
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     		<li>Keterangan Baik</li>
     	</ul>
     </td>
    
  </tr>
  <td colspan="3" rowspan="4" style="width: 50%;font-size: 10px; padding: 10px;"><p>Note: Dengan menandatangani Surat Jalan ini, kami akan menyetujui hal sbb:</p>
  		<p>1. Setelah serah terima, unit menjadi tanggung jawab penyewa dan segala kehilangan atau kerusakan akan diganti saat itu juga</p>
  		<p>2. Kehilangan/Kerusakan Handy Talky sebesar Rp 1.500.000/unit, Antena Rp 200.000/pcs, Hansfree Rp 50.000/unit, Clearcom 12.000 USD/unit, Megaphone TOA Rp 600.000/unit, Baterai TOA Rp 20.000/pcs, Eartec Rp 5.000.000/unit</p>
  		<p>3. Penyewa akan menjaga unit dengan Sebaik-baiknya </p></td>
  	<td colspan="3" style="text-align: center;height: 26px; border-bottom: none;"> Jakarta, 20 November 2019</td>
  	<tr style="height: 26px; text-align: center;">
  		<td style="border: none;">Penerima</td>
  		<td colspan="2" style="border: none;">Pengirim</td>
  	</tr>
  <tr>
  	<td style="border: none;"></td>
  	<td colspan="2" style="border: none;" >
  	</td>
  </tr>
  <tr style="height: 26px; text-align: center;">
  	<td style="border: none;">(	&nbsp;    	&nbsp;    	&nbsp;     	&nbsp; 	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp; &nbsp;)</td>
  	<td colspan="2" style="border: none;">(	&nbsp;    	&nbsp;    	&nbsp;     	&nbsp; 	&nbsp;	&nbsp;	&nbsp;	Operational&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp; &nbsp;)</td>
  </tr>
</table>
<script type="text/javascript">

  window.print();

</script>
</body>
</html>
