<div class="card card-solid">
     <div class="card-body pb-0">

<!-- isi -->
<div class="col-md-12">
     <div class="card card-primary">
          <div class="card-header">
               <h3 class="card-title">Akun Saya</h3>
          </div>
          <div class="card-body">
          <?php 
              echo validation_errors('<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i>','</h5> </div>');

              if (isset($error_upload)) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i>' . $error_upload . '</h5> </div>'; 
              }
              echo form_open_multipart('pelanggan/akun/' . $pelanggan->id_pelanggan) ?>
               <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" value="<?= $pelanggan->nama_pelanggan ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <label>Email</label>
                        <input name="email" class="form-control" placeholder="Email" value="<?= $pelanggan->email ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="******" disabled >
                      </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat Pelanggan"  required><?= $pelanggan->alamat ?></textarea>
                        </div>
                  
                        <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control" id="preview_gambar">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                        <img src="<?= base_url('assets/gambar/nopoto1.jpg') ?>" id="gambar_load" width="400px">
                  </div>
                </div>
                </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                      <a href="<?= base_url('Home') ?>" class="btn btn-success btn-sm">Kembali</a>
                  </div>

               <?php echo form_close() ?>
          </div>
     </div>
</div>


     </div>
</div>
<script>
function bacaGambar(input){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#gambar_load').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#preview_gambar").change(function(){
bacaGambar(this);

});
</script>