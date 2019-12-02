  <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <div class="col">
          	  <div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Jadwal Pengiriman </h6>
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
                       <th>Alamat Antar</th>
                      <th>No Telephone</th>
                      <th>Unit</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Pengirim</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>No RFO</th>
                      <th>Nama</th>
                      <th>Tanggal Antar</th>
                      <th>Venue</th>
                      <th>Alamat Antar</th>
                      <th>No Telephone</th>
                      <th>Unit</th>
                      <th>Jumlah</th>
                      <th>Harga</th>                      
                      <th>Pengirim</th>
                       <th>Status</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    <?php $i=1; ?>
                      <?php foreach ($jadwal as $h) :?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $h['noRFO']; ?></td>
                        <td><?= $h['NamaPemesan']; ?></td>
                        <td><?= $h['TanggalAntar']; ?></td>
                        <td><?= $h['Venue']; ?></td>
                        <td><?= $h['AlamatAntar']; ?></td>
                        <td><a href="https://api.whatsapp.com/send?phone=<?= $h['NoTlp']; ?>&text=Hallo%20saya%20dari%20Momototoy%20mau%20antar%20unit" target="_blank"><?= $h['NoTlp']; ?></a></td>
                        <td><?= $h['Orderan']; ?></td>
                        <td><?= $h['JumlahUnit']; ?></td>
                        <td><?= number_format($h['TotalHarga'], 0, ',','.') ?></td>
                        <td><?= $h['Personil']; ?></td>
                        <td></td>
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