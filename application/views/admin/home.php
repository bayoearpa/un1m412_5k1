    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pencatarma</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php 
    if(isset($_GET['pesan'])){
      if($_GET['pesan'] == "gagal"){
        echo "<div class='alert alert-danger'>Login gagal! Username dan password salah.</div>";
      }else if($_GET['pesan'] == "logout"){
        echo "<div class='alert alert-danger'>Anda telah logout.</div>";
      }else if($_GET['pesan'] == "belumlogin"){
        echo "<div class='alert alert-success'>Silahkan login dulu.</div>";
      }
    }
    ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No. Pencatatan</th>
                  <th>Judul</th>
                  <th>Nama Penulis</th>
                  <th>No. Pemohon</th>
                  <th>Skema</th>
                  <th>proses</th>
                </tr>
                </thead>
                <tbody>
               <?php foreach ($hki as $h): ?>
                <tr>
                  <td><?php echo $h->no_pencatatan; ?></td>
                  <td><?php echo $h->judul; ?></td>
                  <td><?php echo $h->nama; ?></td>
                  <td><?php echo $h->no_pemohon; ?></td>
                  <td><?php 
                  if ($h->no_pencatatan == '1') {
                    # code...
                    echo "<label>Hak Cipta</label>";
                  }else{
                    echo "<label>Karya Cipta</label>";
                  }

                   ?></td>
                   <td><a class="btn btn-warning btn-sm" href="<?php echo base_url().'admin/edit/'.$h->id_hki; ?>"><i class="fa fa-pencil"></i>Edit</a>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url().'admin/delete/'.$h->id_hki; ?>"><i class="fa fa-pencil"></i>Delete</a>
                   </td>
                </tr>
                 
               <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No. Pencatatan</th>
                  <th>Judul</th>
                  <th>Nama Penulis</th>
                  <th>No. Pemohon</th>
                  <th>Skema</th>
                  <th>proses</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->