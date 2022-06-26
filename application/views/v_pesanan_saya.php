<div class="row">


              <div class="col-sm-12">
              <?php
              if ($this->session->flashdata('pesan')) {
                  echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>';
                  echo $this->session->flashdata('pesan');
                  echo '</h5></div>';
              }

              ?>
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Order</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pesanan diproses</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Pesanan dikirim</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Pesanan diterima</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                      <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Total Bayar</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($belum_bayar as $key => $value) { ?>
                          <tr>
                            <td><?= $value->no_order ?></td>
                            <td><b>Rp. <?= number_format($value->grand_total, 0) ?></b><br>
                                <?php if ($value->status_bayar==0) { ?>
                                  <span class="badge badge-warning">Belum bayar</span>
                                <?php } else { ?>
                                  <span class="badge badge-danger">Sudah bayar</span><br>
                                  <span class="badge badge-secondary">Verif</span>
                                <?php } ?>
                                </td>
                            <td>
                            <?php if ($value->status_bayar==0) { ?>
                              <a href="<?= base_url('pesanan_saya/bayar/' . $value->id_transaksi) ?>" class="btn btn-sm btn-flat btn-danger">Bayar</a>
                                <?php } ?>
                              
                            </td>
                        </tr>
                        <?php } ?>
                        
                      </table>
                </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                  <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Total Bayar</th>
                        </tr>
                        <?php foreach ($diproses as $key => $value) { ?>
                          <tr>
                            <td><?= $value->no_order ?></td>
                            <td><b>Rp. <?= number_format($value->grand_total, 0) ?></b><br>
                                
                                  
                                  <span class="badge badge-danger">Terverifikasi</span><br>
                                  <span class="badge badge-secondary">Diproses/Dikemas</span>
                               
                                </td>
                        </tr>
                        <?php } ?>
                        
                      </table> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                  <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Total Bayar</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($dikirim as $key => $value) { ?>
                          <tr>
                            <td><?= $value->no_order ?></td>
                            <td><b>Rp. <?= number_format($value->grand_total, 0) ?></b><br>
                                
                                  
                                  <span class="badge badge-danger">Dikirim</span><br>

                               
                                </td>
                                <td>
                                  <button data-toggle="modal" data-target="#diterima<?= $value->id_transaksi ?>" class="btn btn-danger btn-xs btn-flat">Pesanan Diterima</a>
                                </td>
                        </tr>
                        <?php } ?>
                        
                      </table> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                  <table class="table">
                        <tr>
                            <th>No Order</th>
                            <th>Total Bayar</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($selesai as $key => $value) { ?>
                          <tr>
                            <td><?= $value->no_order ?></td>
                            <td><b>Rp. <?= number_format($value->grand_total, 0) ?></b><br>
                                
                                  
                                  <span class="badge badge-danger">Diterima</span><br>

                               
                                </td>
                                <td>
                                <a href="<?= base_url('pesanan_saya/invoice/'.$value->no_order.'') ?>" class="btn btn-sm btn-flat btn-danger">Cetak Invoice</a>                              
                            </td>
                        </tr>
                        <?php } ?>
                        
                      </table> 
                  </div>
                </div>
              </div>
            </div>
              </div>
</div>
              <br>
              <br>

              <?php foreach ($dikirim as $key => $value) { ?>
              <div class="modal fade" id="diterima<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pesanan Diterima</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Apakah Anda Yakin Pesanan Sudah Diterima?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <a href="<?= base_url('pesanan_saya/diterima/' . $value->id_transaksi) ?>" type="button" class="btn btn-primary">Ya</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <?php } ?>