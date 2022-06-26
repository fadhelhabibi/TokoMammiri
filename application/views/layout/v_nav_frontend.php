<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light bg-brown sticky-top">
    <div class="container">
      <a href="<?= base_url()?>" class="navbar-brand">
        <!--img src="<?= base_url() ?>assets/gambar/mammiri.png" width="50px"-->
        <i class="fas fa-store text-dark"></i>
        <span class="brand-text font-weight-light"><b>Mammiri</b></span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?= base_url()?>" class="nav-link">Home</a>
          </li>
          
          <?php $kategori = $this->m_home->get_all_data_kategori(); ?>

          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Daftar Menu</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

              <?php foreach ($kategori as $key => $value) { ?>
                <li><a href="<?= base_url('home/kategori/' . $value->id_kategori) ?>" class="dropdown-item"><?= $value->nama_kategori ?></a></li>
              <?php } ?>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="https://www.google.co.id/maps/place/Markisa+Mammiri+-+Produk+Khas+Asli+Makassar/@-5.2156928,119.3896458,17z/data=!3m1!4b1!4m5!3m4!1s0x2dbf1d8fa4f02ff5:0x1faecbc071d9f4b5!8m2!3d-5.2156816!4d119.3917966" class="nav-link">Outlet Kami</a>
          </li>

          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Information</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="https://api.whatsapp.com/send?phone=628123123123&text=Hallo!%20ada%20yang%20bisa%20kami%20bantu?" class="dropdown-item">Hubungi Kami </a></li>
              <li><a href="<?= base_url('home/tentang') ?>" class="dropdown-item">Tentang Kami</a></li>
            </ul>
          </li>
        </ul>

        
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <?php if ($this->session->userdata('email') == "") { ?>
            <a class="nav-link" href="<?= base_url('pelanggan/register') ?>">
            <button type="button" class="btn btn-block btn-outline-info btn-sm"><span class="brand-text font-weight-light">Login / Register</span></button>
        </a>
          <?php } else{ ?>
            <a class="nav-link" data-toggle="dropdown" href="#">
             <span class="brand-text font-weight-light text-dark"><b><?= $this->session->userdata('nama_pelanggan') ?></b></span>
             <img src="<?= base_url() ?>assets/gambar/<?=$this->session->userdata('foto')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
            </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('pelanggan/akun') ?>" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Akun Saya
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('Pesanan_saya') ?>" class="dropdown-item">
              <i class="fas fa-shopping-cart mr-2"></i> Pesanan Saya
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('pelanggan/logout') ?>" class="dropdown-item dropdown-footer">Log Out</a>
          </div>

          <?php } ?>
        </li>
        
        <?php
        $keranjang = $this->cart->contents();
        $jml_item = 0;
        foreach ($keranjang as $key => $value) {
          $jml_item = $jml_item + $value['qty'];
        }
        ?>

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-shopping-cart btn-sm"></i>
            <span class="badge badge-danger navbar-badge"><?= $jml_item ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php if (empty($keranjang)) { ?>
              <a href="#" class="dropdown-item">
              <p>Keranjang Belanja Kosong</p></a>
            <?php } else{
           foreach ($keranjang as $key => $value) { 
                $barang = $this->m_home->detail_barang($value['id']);
            ?>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= base_url('assets/gambar/' . $barang->gambar)?>" alt="User Avatar" class="img-size-50 mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?= $value['name'] ?>
                  </h3>
                  <p class="text-sm"><?= $value['qty'] ?> x Rp.<?= number_format($value['price'], 0) ?></p>
                  <p class="text-sm text-muted">
                    <i class="fa fa-calculator"></i> Rp.<?=$this->cart->format_number($value['subtotal'])
                    ; ?>
                     </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <?php } ?>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <div class="media-body">
                <tr>
                 <td colspan="2"> </td>
                <td class="right"><strong>Total</strong></td>
                  <td class="right">Rp. <?= $this->cart->format_number($this->cart->total()); ?></td>
                  </tr>
                </div>
              </div>
              <!-- Message End -->
            </a>

            <div class="dropdown-divider"></div>
            <a href="<?= base_url('belanja') ?>" class="dropdown-item dropdown-footer">View Cart</a>
            <a href="<?= base_url('belanja/cekout') ?>" class="dropdown-item dropdown-footer">Check Out</a>
            <?php } ?>
           
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <?= $title ?> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Mammiri</a></li>
              <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">