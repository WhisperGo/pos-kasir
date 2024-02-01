<?php

namespace App\Controllers;
use App\Models\M_produk;

class Produk extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_produk();

            $data['jojo'] = $model->tampil('produk');

            $data['title'] = 'Data Produk';
            $data['desc'] = 'Anda dapat melihat Data Produk di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function create()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            $data['title'] = 'Data Produk';
            $data['desc'] = 'Anda dapat menambah Data Produk di Menu ini.';      
            $data['subtitle'] = 'Tambah Produk';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('nama_produk');
            $b = $this->request->getPost('harga_produk');
            $c = $this->request->getPost('stok_produk');

            // Data yang akan disimpan
            $data1 = array(
                'NamaProduk' => $a,
                'Harga' => $b,
                'Stok' => $c
            );

            // Simpan data ke dalam database
            $model = new M_produk();
            $model->simpan('produk', $data1);

            return redirect()->to('produk');
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();
            $where=array('ProdukID'=>$id);
            $data['jojo']=$model->getWhere('produk',$where);

            $data['title'] = 'Data Produk';
            $data['desc'] = 'Anda dapat mengedit Data Produk di Menu ini.';      
            $data['subtitle'] = 'Edit Data Produk';  

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/edit', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
           $a = $this->request->getPost('nama_produk');
            $b = $this->request->getPost('harga_produk');
            $c = $this->request->getPost('stok_produk');

            $id = $this->request->getPost('id');

            // Data yang akan disimpan
            $data1 = array(
                'NamaProduk' => $a,
                'Harga' => $b,
                'Stok' => $c
            );

            $where = array('ProdukID' => $id);
            $model = new M_produk();
            $model->qedit('produk', $data1, $where);

            return redirect()->to('produk');
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();
            $model->deletee($id);
            return redirect()->to('produk');
        }else {
            return redirect()->to('/');
        }
    }


    // --------------------------------- STOK produk MASUK -----------------------------------------


    public function menu_stok($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            // Mengambil Data Produk masuk berdasarkan id produk
            $data['jojo'] = $model->getprodukMasukById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok produk';
            $data['desc'] = 'Anda dapat melihat Stok produk di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok produk';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/menu_stok', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function info_stok_masuk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            // Mengambil Data Produk masuk berdasarkan id produk
            $data['jojo'] = $model->getprodukMasukById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok produk Masuk';
            $data['desc'] = 'Anda dapat melihat Stok produk Masuk di Menu ini.';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/view_stok_masuk', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function add_stok_masuk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            $where=array('id_produk'=>$id);
            $data['jojo']=$model->getWhere('produk',$where);

            $data['title'] = 'Data Stok produk Masuk';
            $data['desc'] = 'Anda dapat menambah Stok produk Masuk di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok produk Masuk';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/add_stok_masuk', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_add_stok_masuk()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('id');
            $b = $this->request->getPost('stok_produk');

            // Data yang akan disimpan
            $data1 = array(
                'produk' => $a,
                'stok_produk_masuk' => $b,
            );

            // Simpan data ke dalam database
            $model = new M_produk();
            $model->simpan('produk_masuk', $data1);

            return redirect()->to('produk/info_stok_masuk/' . $a);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete_stok_masuk($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_produk();

        // Mengambil ID produk terkait dari stok produk masuk yang akan dihapus
            $stok_masuk = $model->getprodukMasukByIdprodukMasuk($id);
            $id_produk = $stok_masuk->produk;

        // Membuat kondisi untuk menghapus stok produk masuk
            $where = array('id_produk_masuk' => $id);
            $model->hapus('produk_masuk', $where);

        // Mengarahkan kembali ke halaman info_stok dengan ID produk yang diperoleh sebelumnya
            // return redirect()->to('produk');
            return redirect()->to('produk/info_stok_masuk/' . $id_produk);
        } else {
            return redirect()->to('/');
        }
    }

    // ---------------------------------- STOK produk KELUAR ---------------------------------------

    public function info_stok_keluar($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            // Mengambil Data Produk masuk berdasarkan id produk
            $data['jojo'] = $model->getprodukKeluarById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok produk Keluar';
            $data['desc'] = 'Anda dapat melihat Stok produk Keluar di Menu ini.';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/view_stok_keluar', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function add_stok_keluar($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_produk();

            $where=array('id_produk'=>$id);
            $data['jojo']=$model->getWhere('produk',$where);

            $data['title'] = 'Data Stok produk Keluar';
            $data['desc'] = 'Anda dapat menambah Stok produk Keluar di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok produk Keluar';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/produk/add_stok_keluar', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_add_stok_keluar()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('id');
            $b = $this->request->getPost('stok_produk');

            // Data yang akan disimpan
            $data1 = array(
                'produk' => $a,
                'stok_produk_keluar' => $b,
            );

            // Simpan data ke dalam database
            $model = new M_produk();
            $model->simpan('produk_keluar', $data1);

            return redirect()->to('produk/info_stok_keluar/' . $a);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete_stok_keluar($id)
    { 
     if (session()->get('level') == 1 || session()->get('level') == 2) {
        $model = new M_produk();

        // Mengambil ID produk terkait dari stok produk masuk yang akan dihapus
        $stok_keluar = $model->getprodukMasukByIdprodukKeluar($id);
        $id_produk = $stok_keluar->produk;

        // Membuat kondisi untuk menghapus stok produk masuk
        $where = array('id_produk_keluar' => $id);
        $model->hapus('produk_keluar', $where);

        // Mengarahkan kembali ke halaman info_stok dengan ID produk yang diperoleh sebelumnya
            // return redirect()->to('produk');
        return redirect()->to('produk/info_stok_keluar/' . $id_produk);
    } else {
        return redirect()->to('/');
    }
}

    // -------------------------------------- PEMINJAM --------------------------------------------

public function peminjam()
{
    if (session()->get('level') == 3) {
        $model = new M_produk(); // Gunakan model M_produk

        $idUser = session()->get('id');

        $on = 'produk.kategori_produk=kategori_produk.id_kategori';
        $data['jojo'] = $model->join2('produk', 'kategori_produk', $on); // Ubah cara Anda mengambil data sesuai kebutuhan

        // Tambahkan informasi apakah produk disukai atau tidak ke dalam data yang akan dikirimkan ke view
        foreach ($data['jojo'] as $riz) {
            $riz->isLiked = $model->isLiked($riz->id_produk, $idUser);
        }

        $data['title'] = 'Data Produk';
        $data['desc'] = 'Anda dapat melihat Data Produk di Menu ini.';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/produk/view_peminjam', $data);
        echo view('hopeui/partial/footer');
    } else {
        return redirect()->to('/');
    }
}

public function aksi_tambah_koleksi($id)
{ 
    if(session()->get('level') == 3) {
        $model = new M_produk();

        $idUser = session()->get('id');

            // Periksa apakah produk sudah ada dalam koleksi pengguna atau belum
        if (!$model->isLiked($id, $idUser)) {
            // Jika belum, tambahkan produk ke dalam koleksi
            $data1 = array(
                'produk' => $id,
                'user' => $idUser
            );
            $model->simpan('koleksi_produk', $data1);
        } else {
            // Jika sudah, hapus produk dari koleksi
            $model->hapusLike($id, $idUser);
        }

        // Arahkan pengguna kembali ke halaman koleksi produk
        return redirect()->to('produk/peminjam');
    } else {
        return redirect()->to('/');
    }
}
}