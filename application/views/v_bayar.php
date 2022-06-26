<div class="row">
<div class="col-sm-6">
<div class="card card-info">
              <!-- /.card-header -->
              <div class="card-header">
                    <h3 class="card-title"> Nomor Rekening Toko </h3>
              </div>
                <div class="card-body">
                <p>Silahkan Transfer Pembayaran ke Rekening Di Bawah Ini Sebesar : 
                    <h3 class="text-info">Rp. <?= number_format($pesanan->grand_total, 0) ?>.-</h3></p><br>
                    <table class="table">
                        <tr>
                            <th>Bank</th>
                            <th>No Rekening</th>
                            <th>Atas Nama</th>
                        </tr>
                        <?php foreach ($rekening as $key => $value) { ?>
                        <tr>
                            <th><?= $value->nama_bank ?></th>
                            <th><?= $value->no_rek ?></th>
                            <th><?= $value->atas_nama ?></th>
                        </tr>
                           <?php } ?>
                        
                        
                    </table>
        </div>
</div>
</div>
    <div class="col-sm-6">
    <div class="card card-info">
              <!-- /.card-header -->
              <div class="card-header">
                    <h3 class="card-title"> Upload Bukti Pembayaran </h3>
              </div>
              <!-- form start -->
              <?php
                echo form_open_multipart('pesanan_saya/bayar/' . $pesanan->id_transaksi);
              ?>
                <div class="card-body">
                  <div class="form-group">
                    <label>Atas Nama</label>
                    <input name="atas_nama" class="form-control" placeholder="Atas Nama" required>
                  </div>
                  <div class="form-group">
                    <label>Nama Bank</label>
                    <input name="nama_bank" class="form-control" placeholder="Nama Bank" required>
                  </div>
                  <div class="form-group">
                    <label>Nomor Rekening</label>
                    <input name="no_rek" class="form-control" placeholder="Nomor Rekening" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Bukti Bayar</label>
                    <input type="file" name="bukti_bayar" class="form-control" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <a href="<?= base_url('pesanan_saya') ?>" class="btn btn-secondary">Back</a>
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              <?php echo form_close() ?>
            </div>
            <!-- /.card -->
    </div>
</div>
<br>