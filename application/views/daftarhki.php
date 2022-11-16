    <div style="height: 113px;"></div>

    <div class="unit-5 overlay" style="background-image: url('<?php echo base_url() ?>assets/1/images/hero_1-2.png');">
      <div class="container text-center">
        <h2 class="mb-0">Daftar HKI</h2>
        <p class="mb-0 unit-6"><a href="<?php echo base_url() ?>">Beranda</a> <span class="sep">></span> <span>Daftar HKI</span></p>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
                <div class="row">
          <div class="col-md-8 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
            <h2 class="mb-5 h3">Daftar HKI</h2>
            <div class="rounded border jobs-wrap">
              <?php foreach ($hki as $k) {
                # code...
              ?>
              <a href="<?php echo base_url().'selengkapnya/'.$k->id_hki; ?>" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                <div class="company-logo blank-logo text-center text-md-left pl-3">
                  <img src="<?php echo base_url() ?>assets/1/images/company_logo_blank.png" alt="Image" class="img-fluid mx-auto">
                </div>
                <div class="job-details h-100">
                  <div class="p-3 align-self-center">
                    <h3><?php echo $k->judul ?></h3>
                    <div class="d-block d-lg-flex">
                      <div class="mr-3"><span class="icon-user mr-1"></span><?php echo $k->nama ?></div>
                     <!--  <div class="mr-3"><span class="icon-room mr-1"></span> Florida</div>
                      <div><span class="icon-money mr-1"></span> $55000 &mdash; 70000</div> -->
                    </div>
                  </div>
                </div>
                <div class="job-category align-self-center">
                  <div class="p-3">
                    <span class="text-info p-2 rounded border border-info">Selengkapnya</span>
                  </div>
                </div>  
              </a>
              <?php  }?>

            </div>

           
          </div>
        </div>
      <!--   <div class="row mt-5">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul>
                <li><a href="#"><i class="icon-keyboard_arrow_left h5"></i></a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#"><i class="icon-keyboard_arrow_right h5"></i></a></li>
              </ul>
            </div>
          </div>
        </div> -->


      </div>
    </div>   
