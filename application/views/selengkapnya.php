    <div style="height: 113px;"></div>

    <div class="unit-5 overlay" style="background-image: url('<?php echo base_url() ?>assets/1/images/hero_1-2.png');">
      <div class="container text-center">
        <h2 class="mb-0">Selengkapnya</h2>
        <p class="mb-0 unit-6"><a href="<?php echo base_url() ?>">Beranda</a> <span class="sep">></span> <a href="<?php echo base_url() ?>daftarhki"><span>Daftar HKI</span></a> <span class="sep">></span> <span>Selengkapnya</span></p>
      </div>
    </div>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
       
          <div class="col-md-12 col-lg-8 mb-5">
          
            
          <?php 
          foreach ($hki as $k) {
            # code...
           ?>
            <form action="#" class="p-5 bg-white">

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Nomor Pencatatan</label>
                </div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <label><?php echo $k->no_pencatatan ?></label>
                </div>
                
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Judul</label>
                </div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <label><?php echo $k->judul ?></label>
                </div>
                
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Nama Penulis</label>
                </div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <label><?php echo $k->nama ?></label>
                </div>
                
              </div>
               <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Nomor Pemohon</label>
                </div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <label><?php echo $k->no_pemohon ?></label>
                </div>
                
              </div>
               <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Tanggal Permohonan</label>
                </div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <label><?php echo $k->tgl_permohonan ?></label>
                </div>
                
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Skema</label>
                </div>
                <div class="col-md-12 mb-3 mb-md-0">

                  <?php 
                  if ($k->no_pencatatan == '2') {
                    # code...
                    echo "<label>Hak Cipta</label>";
                  }else{
                    echo "<label>Karya Cipta</label>";
                  }

                   ?>
                </div>
                
              </div>
  
            </form>
            <?php } ?>
          </div>

          <div class="col-lg-4">
            <!-- <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">Contact Info</h3>
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">youremail@domain.com</a></p>

            </div> -->
            
            <div class="p-4 mb-3 bg-white">
             <?php 
                    if(empty($k->file)) {echo "<img src='".base_url()."assets/upload/no_image_thumb.png' width='300'>";}  
                    else { echo " <img src='".base_url()."assets/upload/".$k->file.''.$k->file_type."' width='300'> ";}
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>