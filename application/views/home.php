<div style="height: 113px;"></div>

    <div class="site-blocks-cover overlay" style="background-image: url('<?php echo base_url() ?>assets/1/images/hero_1.jpeg');" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12" data-aos="fade">
            <h1>Pencarian</h1>
            <form action="<?php echo base_url() ?>carihki" method="post">
              <div class="row mb-3">
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-12 mb-5 mb-md-1">
                      <input type="text" name="search" id="search" class="mr-3 form-control border-0 px-4" placeholder="Judul atau penulis ">
                    </div>
                   <!--  <div class="col-md-6 mb-3 mb-md-0">
                      <div class="input-wrap">
                        <span class="icon icon-room"></span>
                      <input type="text" class="form-control form-control-block search-input  border-0 px-4" id="autocomplete" placeholder="city, province or region" onFocus="geolocate()">
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="col-md-3">
                  <input type="submit" class="btn btn-search btn-primary btn-block" value="Cari">
                </div>
              </div>
             <!--  <div class="row">
                <div class="col-md-12">
                  <p class="small">or browse by category: <a href="#" class="category">Category #1</a> <a href="#" class="category">Category #2</a></p>
                </div>
              </div> -->
              
            </form>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto text-center mb-5 section-heading">
            <h2 class="mb-5">Daftar HKI</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">
            <a href="<?php echo base_url() ?>/paten" class="h-100 feature-item">
              <span class="d-block icon icon-book mb-3 text-primary"></span>
              <h2>Karya Cipta</h2>
              <?php 
            $where = array(
            'skema' => '1'     
            );
             $where2 = array(
            'skema' => '2'     
            );
            ?>
              <span class="counting"><?php echo $this->m_hki->get_data($where,'hki')->num_rows(); ?></span>
            </a>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="200">
            <a href="<?php echo base_url() ?>/hakcipta" class="h-100 feature-item">
              <span class="d-block icon icon-folder2 mb-3 text-primary"></span>
              <h2>Hak Cipta</h2>
              <span class="counting"><?php echo $this->m_hki->get_data($where2,'hki')->num_rows(); ?></span>
            </a>
          </div>

        </div>

      </div>
    </div>
