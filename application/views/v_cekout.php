<!-- Main content -->
<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-shopping-cart"></i> CekOut Belanja
                    <small class="float-right">Date: <?= date('d-m-y') ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Nama Barang</th>
                      <th style="text-align:center">Harga </th>
                      <th style="text-align:right">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items){ ?>
                    <tr>
                    <td><?php echo $items['qty']; ?></td>
                    <td><?php echo $items['name']; ?></td>
                    <td style="text-align:center">Rp. <?php echo number_format($items['price'], 0); ?></td>
                    <td style="text-align:right"><b>Rp. <?php echo number_format($items['subtotal'], 0); ?></b></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <?php
                echo validation_errors('<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i>','</h5> </div>');
                ?>
<?php 

echo form_open('belanja/cekout');
$no_order = date('Ymd') . strtoupper(random_string('alnum', 8));

?>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-sm-8 invoice-col">
                  <p class="lead">Keterangan CekOut :</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Sebelum melakukan CekOut sebaiknya anda melakukan Screenshoot terlebih dahulu! Hanya area Makassar dan sekitarnya. dan ongkir akan dikenakan biaya sebesar Rp. 15,000 setiap pengiriman.
                  </p>
                  <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nomor Order</label>
                        <input name="no_order" type="text" class="form-control" value="<?= $no_order ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Penerima</label>
                        <input name="nama_penerima" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>No HP Penerima</label>
                        <input name="nohp_penerima" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Alamat Lengkap Penerima</label>
                        <input name="alamat" type="text" class="form-control" required>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Grand total:</th>
                        <td>Rp. <?php echo number_format($this->cart->total(), 0); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <input name="grand_total" value="<?= $this->cart->total() ?>" hidden>

              <?php
              $i = 1;
              foreach ($this->cart->contents() as $items) {
                echo form_hidden('qty' . $i++, $items['qty']);
              }
              ?>


              <!-- this row will not appear when printing -->
              <br>
              <br>
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?= base_url('belanja') ?>" class="btn btn-secondary"><i class="fas fa-backward"></i> Kembali</a>
                  <a href="<?= base_url('Pesanan_saya') ?>"><button type="submit" class="btn btn-info float-right"><i class="fas fa-shopping-cart"></i> Proses Cekout
                  </button></a>
                </div>
              </div>
              <?php echo form_close() ?>
            </div>