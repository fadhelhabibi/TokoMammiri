<?php



?>
<!-- Main content -->
<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-file-invoice"></i> Kwitansi Pembayaran
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

<?php foreach ($data_barang as $items){ ?>
                    <tr>
                    <td><?php echo $items->qty; ?></td>
                    <td><?php echo $items->nama_barang; ?></td>
                    <td style="text-align:center">Rp. <?php echo number_format($items->harga, 0); ?></td>
                    <td style="text-align:right"><b>Rp. <?php echo number_format($items->subtotal, 0); ?></b></td>
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

echo form_open('pesanan_saya/invoice');
$no_order = date('Ymd') . strtoupper(random_string('alnum', 8));

?>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-sm-8 invoice-col">
                  <p class="lead">Keterangan :</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                   Terima Kasih sudah berbelanja, jangan lupa datang kembali.
                  </p>
                  
                  <div class="row">
                  <div class="col-sm-">
                  <div class="card-footer">
                  <a href="#" class="btn btn-secondary no-print" onclick="window.print()"  onclick="window.print()"><i class="fas fa-print fa-lg mr-2"></i>Cetak Invoice</a>
  
                </div>
                    </div>
                    <div class="col-sm-">
                    <div class="card-footer">
                    <a href="<?= base_url('pesanan_saya') ?>" class="btn btn-danger no-print">Back</a>
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
              
              <?php echo form_close() ?>
            </div>