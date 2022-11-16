    <!-- Main content -->
    <section class="content">
       <?php echo $this->session->flashdata('message');?>
      <div class="row">
       
 <!-- left column -->
          <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          <form method="post" action="<?php echo base_url() ?>admin/insertp" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label>No. Pencatatatan</label>
                  <input type="text" class="form-control autocomplete" id="no_pencatatan" name="no_pencatatan" placeholder="No Pencatatatan">
                </div>
                <div class="form-group">
                  <label>Judul</label>
                  <textarea class="form-control" id="judul" name="judul"></textarea>
                  
                </div>
                <div class="form-group">
                  <label>Nama Penulis</label>
                  <input type="text" class="form-control autocomplete" id="nama" name="nama" placeholder="Nama Author">
                </div>
                <div class="form-group">
                  <label>No. Pemohon</label>
                  <input type="text" class="form-control autocomplete" id="no_pemohon" name="no_pemohon" placeholder="No Pemohon">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Pemohon</label>
                       <div class="input-group date" data-provide="datepicker">
                          <input type="text" class="form-control" data-date-format="yyyy-mm-dd" data-link-format="yyyy-mm-dd" name="tgl_permohonan" id="tgl_permohonan">
                          <div class="input-group-addon">
                              <span class="glyphicon glyphicon-th"></span>
                          </div>
                      </div>                      
                </div>
                    <div class="form-group">
                      <label> Skema
                    </label>
                    <select name="skema" id="skema" class="form-control" style="width:50%;">  
                    <option selected>== Pilih ==</option>
                    <option value="1">Karya Cipta</option>
                    <option value="2">Hak Cipta</option>                       
                    </select> 
                    </div>
                  
                     <div class="form-group">
                  <label>Gambar</label>
                  <input type="file" class="form-control" name="file" id="file" onchange="tampilkanPreview(this,'preview')"/>
                <br><p><b>Preview Gambar</b><br>
                <img id="preview" src="" alt="" width="350px"/>
                </div>


                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
              <!-- /.box-body -->
         
          </div>
          <!-- /.box -->
          </div>
   </form>

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