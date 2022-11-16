<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_hki');
        $this->load->helper('judul_seo');
    }

	public function index()
	{
		$this->load->view('login');
	}

	function login()
    {
    	# code...
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		if($this->form_validation->run() != false){
			$where = array(
				'user' => $username,
				'password' => md5($password)			
			);
			$data = $this->m_hki->get_data($where,'user');
			$d = $this->m_hki->get_data($where,'user')->row();
			$cek = $data->num_rows();
			if($cek > 0){
				$session = array(
					'id'=> $d->id,
					'user'=> $d->user,
					'status' => 'login'
				);
				$this->session->set_userdata($session);
				redirect(base_url().'admin/home');
				// if ($d->level=='1') {
				// 		# code...
				// 		redirect(base_url().'bau/index');
				// 	}elseif ($d->level=='2') {
				// 		# code...
				// 		redirect(base_url().'baak/index');
				// 	}elseif ($d->level=='3'){
				// 		redirect(base_url().'umum/index');
				// 	}
			}else{
				redirect(base_url().'administrasi?pesan=gagal');			
			}
		}else{
			$this->load->view('login');
		}
    }
     function logout(){
    $this->session->sess_destroy();
    redirect(base_url().'admin?pesan=logout');
  }
    function home()
    {
    	# code...
    	$data['hki']=$this->m_hki->get_data_all('hki')->result();
    	$this->load->view('admin/header');
    	$this->load->view('admin/home',$data);
    	$this->load->view('admin/footer');
    	
    }
    function edit($id)
    {
    	# code...
    	$where = array(
				'id_hki' => $id,			
			);
		$data['hki']=$this->m_hki->get_data($where,'hki')->result();
    	$this->load->view('admin/header');
    	$this->load->view('admin/edit',$data);
    	$this->load->view('admin/footer');
    	
    }
	function insert()
    {
    	# code...
    	$this->load->view('admin/header');
    	$this->load->view('admin/insert');
    	$this->load->view('admin/footer');
    	
    }
    public function editp()
    {
      # code...
        # code...
    /* Jika file upload tidak kosong*/
        /* 4 adalah menyatakan tidak ada file yang diupload*/
        $ididan=$this->input->post('id_hki');
        if ($_FILES['file']['error'] <> 4) 
        {

          //identifikasi folder
          $where = array(
            'id_hki' => $ididan    
              );
          
            $this->db->select("file, file_type");
            $this->db->where($where);
            $query = $this->db->get('hki');
            $row2 = $query->row();        

            // menyimpan lokasi gambar dalam variable
            $dir = "assets/upload/".$row2->file.$row2->file_type;

             if ($row2) 
                {
                  // Hapus foto
                  unlink($dir);
                }  // Jika data tidak ada
                  else 
                  {
                    $this->session->set_flashdata('message', 'Data tidak ditemukan');
                    redirect(site_url('admin/home'));
                  }

          $nmfile = judul_seo($this->input->post('no_pemohon'));

          /* memanggil library upload ci */
          $config['upload_path']      = './assets/upload/';
          $config['allowed_types']    = 'jpg|jpeg|png|gif';
          $config['max_size']         = '2048'; // 2 MB
          $config['max_width']        = '3000'; //pixels
          $config['max_height']       = '5000'; //pixels
          $config['file_name']        = $nmfile; //nama yang terupload nantinya

          $this->load->library('upload', $config);
          
          if (!$this->upload->do_upload('file'))
          {   //file gagal diupload -> kembali ke form tambah
            // $this->insert();
            echo "GAGAL COKKK!!!";
          } 
            //file berhasil diupload -> lanjutkan ke query INSERT
            else 
            { 
              $userfile = $this->upload->data();
              $thumbnail                = $config['file_name']; 
              // library yang disediakan codeigniter
              $config['image_library']  = 'gd2'; 
              // gambar yang akan dibuat thumbnail
              $config['source_image']   = './assets/upload'.$userfile['file_name'].''; 
              // membuat thumbnail
              $config['create_thumb']   = TRUE;               
              // rasio resolusi
              $config['maintain_ratio'] = FALSE; 
              // lebar
              $config['width']          = 400; 
              // tinggi
              $config['height']         = 200; 

              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $where = array(
                'id_hki' => $ididan,  
              );

              $data = array(
                'no_pencatatan'  => $this->input->post('no_pencatatan'),
                  'nama'    => $this->input->post('nama'),
                  'judul'      => $this->input->post('judul'),
                  'no_pemohon'        => $this->input->post('no_pemohon'),
                  'tgl_permohonan'        => $this->input->post('tgl_permohonan'),
                  'skema'       => $this->input->post('skema'),

                  'file'      => $nmfile,
                  'file_type' => $userfile['file_ext'],
                  'file_size' => $userfile['file_size']
              );

              // eksekusi query INSERT
              // $this->m_hki->input_data($data,'hki');
              $this->m_hki->update_data($where, $data, 'hki');
              // set pesan data berhasil dibuat

              redirect('admin/home');
            }
        }else // Jika file upload kosong
        {
          $where = array(
            'id_hki' => $ididan,  
          );
          $data = array(
            'no_pencatatan'  => $this->input->post('no_pencatatan'),
            'nama'    => $this->input->post('nama'),
            'judul'      => $this->input->post('judul'),
            'no_pemohon'        => $this->input->post('no_pemohon'),
            'tgl_permohonan'        => $this->input->post('tgl_permohonan'),
            'skema'       => $this->input->post('skema'),
          );

          // eksekusi query INSERT
          // $this->m_hki->input_data($data,'hki');
          $this->m_hki->update_data($where, $data, 'hki');
          // set pesan data berhasil dibuat
          redirect('admin/home');
        }
    }
    // edit lama
    public function editpp() 
  	{

        $nmfile = judul_seo($this->input->post('no_pemohon'));
        $ididan=$this->input->post('id_hki');
        $id['id_hki'] = $this->input->post('id_hki'); 
        
        /* Jika file upload diisi */
        if ($_FILES['file']['error'] <> 4) 
        {
          // select column yang akan dihapus (gambar) berdasarkan id
          $this->db->select("file, file_type");
          $this->db->where($id);
          $query = $this->db->get('hki');
          $row = $query->row();        

          // menyimpan lokasi gambar dalam variable
          $dir = "./assets/upload/".$row->file.$row->file_type;
          // $dir_thumb = "./assets/upload/".$row->file.'_thumb'.$row->file_type;

          // Jika ada foto lama, maka hapus foto kemudian upload yang baru
          if($dir)
          {
            $nmfile = judul_seo($this->input->post('no_pemohon'));
            
            // Hapus foto
            unlink($dir);
            // unlink($dir_thumb);

            //load uploading file library
            $config['upload_path']      = './assets/upload';
            $config['allowed_types']    = 'jpg|jpeg|png|gif';
            $config['max_size']         = '2048'; // 2 MB
            $config['max_width']        = '2000'; //pixels
            $config['max_height']       = '2000'; //pixels
            $config['file_name']        = $nmfile; //nama yang terupload nantinya

            $this->load->library('upload', $config);
            
            // Jika file gagal diupload -> kembali ke form update
            if (!$this->upload->do_upload())
            {   
              $this->editp();
            } 
              // Jika file berhasil diupload -> lanjutkan ke query INSERT
              else 
              { 
                $userfile = $this->upload->data();
                // library yang disediakan codeigniter
                $thumbnail                = $config['file_name']; 
                //nama yang terupload nantinya
                $config['image_library']  = 'gd2'; 
                // gambar yang akan dibuat thumbnail
                $config['source_image']   = './assets/upload'.$userfile['file_name'].''; 
                // membuat thumbnail
                $config['create_thumb']   = TRUE;               
                // rasio resolusi
                $config['maintain_ratio'] = FALSE; 
                // lebar
                $config['width']          = 400; 
                // tinggi
                $config['height']         = 200; 

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $where = array(
                      'id_hki' => $ididan,  
                      );
                $data = array(
                  'no_pencatatan'  => $this->input->post('no_pencatatan'),
                  //'no_pencatatan'     => judul_seo($this->input->post('no_pencatatan')),
                  'nama'    => $this->input->post('nama'),
                  'judul'      => $this->input->post('judul'),
                  'no_pemohon'        => $this->input->post('no_pemohon'),
                  'tgl_permohonan'        => $this->input->post('tgl_permohonan'),
                  'skema'       => $this->input->post('skema'),

                  'file'      => $nmfile,
                  'file_type' => $userfile['file_ext'],
                  'file_size' => $userfile['file_size']
                );

                $this->m_hki->update_data($where, $data, 'hki');
                redirect('admin/home');
              }
          }
            // Jika tidak ada foto pada record, maka upload foto baru
            else
            {
              //load uploading file library
              $config['upload_path']      = './assets/upload';
              $config['allowed_types']    = 'jpg|jpeg|png|gif';
              $config['max_size']         = '2048'; // 2 MB
              $config['max_width']        = '2000'; //pixels
              $config['max_height']       = '2000'; //pixels
              $config['file_name']        = $nmfile; //nama yang terupload nantinya

              $this->load->library('upload', $config);
              
              // Jika file gagal diupload -> kembali ke form update
              if (!$this->upload->do_upload())
              {   
                $this->edit();
              } 
                // Jika file berhasil diupload -> lanjutkan ke query INSERT
                else 
                { 
                  $userfile = $this->upload->data();
                  // library yang disediakan codeigniter
                  $thumbnail                = $config['file_name']; 
                  //nama yang terupload nantinya
                  $config['image_library']  = 'gd2'; 
                  // gambar yang akan dibuat thumbnail
                  $config['source_image']   = './assets/upload'.$userfile['file_name'].''; 
                  // membuat thumbnail
                  $config['create_thumb']   = TRUE;               
                  // rasio resolusi
                  $config['maintain_ratio'] = FALSE; 
                  // lebar
                  $config['width']          = 400; 
                  // tinggi
                  $config['height']         = 200; 

                  $this->load->library('image_lib', $config);
                  $this->image_lib->resize();

                  $where = array(
                      'id_hki' => $ididan,  
                      );
                  $data = array(
                  'no_pencatatan'  => $this->input->post('no_pencatatan'),
                  //'no_pencatatan'  => judul_seo($this->input->post('no_pencatatan')),
                  'nama'           => $this->input->post('nama'),
                  'judul'          => $this->input->post('judul'),
                  'no_pemohon'     => $this->input->post('no_pemohon'),
                  'tgl_permohonan' => $this->input->post('tgl_permohonan'),
                  'skema'          => $this->input->post('skema'),

                  'file'           => $nmfile,
                  'file_type'      => $userfile['file_ext'],
                  'file_size'      => $userfile['file_size']
                  );

                  $this->m_hki->update_data($where, $data, 'hki');
                  redirect('admin/home');
                }
            }
        }
          // Jika file upload kosong
          else 
          {
            $where = array(
                      'id_hki' => $ididan,  
                      );
            $data = array(
            'no_pencatatan'        => $this->input->post('no_pencatatan'),
            'nama'                 => $this->input->post('nama'),
            'judul'                => $this->input->post('judul'),
            'no_pemohon'           => $this->input->post('no_pemohon'),
            'tgl_permohonan'       => $this->input->post('tgl_permohonan'),
          	'skema'                => $this->input->post('skema')
            );

            $this->m_hki->update_data($where, $data, 'hki');
            redirect('admin/home');
          }
       
  	}
  	public function insertp()
	{
		# code...
		/* Jika file upload tidak kosong*/
        /* 4 adalah menyatakan tidak ada file yang diupload*/
        if ($_FILES['file']['error'] <> 4) 
        {
          $nmfile = judul_seo($this->input->post('no_pemohon'));

          /* memanggil library upload ci */
          $config['upload_path']      = './assets/upload/';
          $config['allowed_types']    = 'jpg|jpeg|png|gif';
          $config['max_size']         = '2048'; // 2 MB
          $config['max_width']        = '3000'; //pixels
          $config['max_height']       = '5000'; //pixels
          $config['file_name']        = $nmfile; //nama yang terupload nantinya

          $this->load->library('upload', $config);
          
          if (!$this->upload->do_upload('file'))
          {   //file gagal diupload -> kembali ke form tambah
            // $this->insert();
            echo "GAGAL COKKK!!!";
          } 
            //file berhasil diupload -> lanjutkan ke query INSERT
            else 
            { 
              $userfile = $this->upload->data();
              $thumbnail                = $config['file_name']; 
              // library yang disediakan codeigniter
              $config['image_library']  = 'gd2'; 
              // gambar yang akan dibuat thumbnail
              $config['source_image']   = './assets/upload'.$userfile['file_name'].''; 
              // membuat thumbnail
              $config['create_thumb']   = TRUE;               
              // rasio resolusi
              $config['maintain_ratio'] = FALSE; 
              // lebar
              $config['width']          = 400; 
              // tinggi
              $config['height']         = 200; 

              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $data = array(
               	'no_pencatatan'  => $this->input->post('no_pencatatan'),
                  'nama'    => $this->input->post('nama'),
                  'judul'      => $this->input->post('judul'),
                  'no_pemohon'        => $this->input->post('no_pemohon'),
                  'tgl_permohonan'        => $this->input->post('tgl_permohonan'),
                  'skema'       => $this->input->post('skema'),

                  'file'      => $nmfile,
                  'file_type' => $userfile['file_ext'],
                  'file_size' => $userfile['file_size']
              );

              // eksekusi query INSERT
              $this->m_hki->input_data($data,'hki');
              // set pesan data berhasil dibuat

              redirect('admin/home');
            }
        }else // Jika file upload kosong
        {
          $data = array(
            'no_pencatatan'  => $this->input->post('no_pencatatan'),
            'nama'    => $this->input->post('nama'),
            'judul'      => $this->input->post('judul'),
            'no_pemohon'        => $this->input->post('no_pemohon'),
            'tgl_permohonan'        => $this->input->post('tgl_permohonan'),
          	'skema'       => $this->input->post('skema'),
          );

          // eksekusi query INSERT
          $this->m_hki->input_data($data,'hki');
          // set pesan data berhasil dibuat
          redirect('admin/home');
        }
	}
  public function delete($id) 
    {
        $where = array(
        'id_hki' => $id    
          );
      
        $this->db->select("file, file_type");
        $this->db->where($where);
        $query = $this->db->get('hki');
        $row2 = $query->row();        

        // menyimpan lokasi gambar dalam variable
        $dir = "assets/upload/".$row2->file.$row2->file_type;

        // Jika data ditemukan, maka hapus foto dan record nya
        if ($row2) 
        {
          // Hapus foto
          unlink($dir);

          $this->m_hki->delete_data($where,'hki');
          redirect(base_url().'admin/home');
        } 
          // Jika data tidak ada
          else 
          {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('admin/home'));
          }
  
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */