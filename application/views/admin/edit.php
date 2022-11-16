<?php 
foreach ($hki as $h) {
  # code...
 ?>
    <!-- Main content -->
    <section class="content">
       <?php echo $this->session->flashdata('message');?>
      <div class="row">
       
 <!-- left column -->
          <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Berita</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          <form method="post" action="<?php echo base_url() ?>admin/editp" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="id_hki" id="id_hki" value="<?php echo $h->id_hki ?>">
                  <label>No. Pencatatatan</label>
                  <input type="text" class="form-control autocomplete" id="no_pencatatan" name="no_pencatatan" placeholder="No. Pencatatatan" value="<?php echo $h->no_pencatatan ?>">
                </div>
                <div class="form-group">
                  <label>Judul</label>
                  <textarea class="form-control" id="judul" name="judul"><?php echo $h->judul; ?></textarea>
                  
                </div>
                <div class="form-group">
                  <label>Nama Penulis</label>
                  <input type="text" class="form-control autocomplete" id="nama" name="nama" placeholder="Nama Penulis" value="<?php echo $h->nama ?>">
                </div>
                <div class="form-group">
                  <label>No. Pemohon</label>
                  <input type="text" class="form-control autocomplete" id="no_pemohon" name="no_pemohon" value="<?php echo $h->no_pemohon ?>" placeholder="No Pemohon">
                </div>
                    <div class="form-group">
                      <label> Skema (jangan di pilih jika tidak ada perubahan )
                    </label>
                    <select name="skema" id="skema" class="form-control" style="width:50%;">  
                    <option selected value="<?php echo $h->skema ?>">== Pilih ==</option>
                    <option value="1">Karya Cipta</option>
                    <option value="2">Hak Cipta</option>                       
                    </select> 
                    </div>
                  
                     <div class="form-group">
                  <label>Gambar (jangan di pilih jika tidak ada perubahan )</label>
                  <input type="file" class="form-control" name="file" id="file" value="<?php echo $h->file ?>" onchange="tampilkanPreview(this,'preview')"/>
                <br><p><b>Preview Gambar</b><br>
                <img id="preview" src="" alt="" width="350px"/>
                </div>


                <button type="submit" class="btn btn-primary">Edit</button>
              </div>
              <!-- /.box-body -->
         
          </div>
          <!-- /.box -->
          </div>
   </form>
   <?php 
    } 
    ?>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{ //membuat objek gambar
  var gb = userfile.files;
  //loop untuk merender gambar
  for (var i = 0; i < gb.length; i++)
  { //bikin variabel
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);            
    var reader = new FileReader();
    if (gbPreview.type.match(imageType)) 
    { //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element) 
      {
        return function(e) 
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      { //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }    
}
</script>