<!-- Default box -->
<div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?= $barang->nama_barang ?></h3>
              <div class="col-12">
                <img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>" class="product-image" alt="Product Image">
              </div>
              
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?= $barang->nama_barang ?></h3>
              <h5>Kategori <?= $barang->nama_kategori ?></h5>
              <p><?= $barang->deskripsi ?></p>
              <p>Stok Barang : <?= $barang->stok ?></p>
              <div class="btn btn-success btn-lg btn-flat">
                <a href="https://www.tokopedia.com/archive-markisamammiri" class="text-white"> 
                <img src="<?= base_url() ?>assets/tokopedia/1.png" class="img-fluid" width="30px"> Tokopedia</a>
                </div>

              <hr>

              <div class=" py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Rp. <?= number_format($barang->harga,0) ?>
                </h2>
              </div>
</hr>
              <?php 
              echo form_open('belanja/add');
              echo form_hidden('id' , $barang->id_barang);
              echo form_hidden('price' , $barang->harga);
              echo form_hidden('name' , $barang->nama_barang);
              echo form_hidden('redirect_page' , str_replace('index.php/','',current_url()));
              ?>
              <div class="mt-4">
                <div class="row">
                <div class="col-sm-2">
                <input type="number" class="form-control" name="qty" value="1" min="1">  
              </div> 
                  <div class="col-sm-8">
                  <button type="submit" class="btn btn-info btn-flat swalDefaultSuccess">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                  Add to Cart
              </button>
                  </div>
                </div>
              </div>
              <?php 
              echo form_close();
              ?>

            </div>
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <script src="<?= base_url() ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Menu berhasil ditambahkan ke keranjang'
      })
    });
  });

</script>