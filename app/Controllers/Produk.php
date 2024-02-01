<?php

namespace App\Controllers;
use App\Models\M_buku;

class Buku extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2  || session()->get('level') == 3) {
            $model = new M_buku();

            $on = 'buku.kategori_buku=kategori_buku.id_kategori';
            $data['jojo'] = $model->join2('buku', 'kategori_buku', $on);

            $data['title'] = 'Data Buku';
            $data['desc'] = 'Anda dapat melihat Data Buku di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function create()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            $data['title'] = 'Data Buku';
            $data['desc'] = 'Anda dapat menambah Data Buku di Menu ini.';      
            $data['subtitle'] = 'Tambah Buku';

            $data['kategori'] = $model->tampil('kategori_buku');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('judul_buku');
            $b = $this->request->getPost('kategori_buku');
            $c = $this->request->getPost('stok_buku');

            $cover_buku = $this->request->getFile('cover_buku');

            if ($cover_buku->isValid() && !$cover_buku->hasMoved()) {
                $ext = $cover_buku->getClientExtension();

                $imageName = 'cover_' . session()->get('id') . '_' . time() . '.' . $ext;

                $cover_buku->move('cover', $imageName);
            } else {
                $imageName = 'default.jpg';
            }

            // Data yang akan disimpan
            $data1 = array(
                'judul_buku' => $a,
                'cover_buku' => $imageName,
                'kategori_buku' => $b,
                'stok_buku' => $c,
            );

            // Simpan data ke dalam database
            $model = new M_buku();
            $model->simpan('buku', $data1);

            return redirect()->to('buku');
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();
            $where=array('id_buku'=>$id);
            $data['jojo']=$model->getWhere('buku',$where);

            $data['title'] = 'Data Buku';
            $data['desc'] = 'Anda dapat mengedit Data Buku di Menu ini.';      
            $data['subtitle'] = 'Edit Data Buku';  

            $data['kategori'] = $model->tampil('kategori_buku');

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/edit', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('judul_buku');
            $b = $this->request->getPost('kategori_buku');
            $c = $this->request->getPost('stok_buku');
            $id = $this->request->getPost('id');

            $cover_buku = $this->request->getFile('cover_buku');

            // Inisialisasi nama file gambar
            $imageName = null;

            // Periksa apakah ada file yang diunggah
            if ($cover_buku->isValid() && !$cover_buku->hasMoved()) {
            // Mendapatkan ekstensi file
                $ext = $cover_buku->getClientExtension();

            // Membuat nama file unik dengan judul buku dan timestamp
                $imageName = 'cover_' . $a . '_' . time() . '.' . $ext;

            // Pindahkan file ke folder cover
                $cover_buku->move('cover', $imageName);
            }

            // Data yang akan disimpan
            $data1 = array(
                'judul_buku' => $a,
                'kategori_buku' => $b,
                'stok_buku' => $c,
            );

            // Jika ada file yang diunggah, tambahkan nama file ke data
            if ($imageName !== null) {
                $data1['cover_buku'] = $imageName;
            }

            $where = array('id_buku' => $id);
            $model = new M_buku();
            $model->qedit('buku', $data1, $where);

            return redirect()->to('buku');
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();
            $model->deletee($id);
            return redirect()->to('buku');
        }else {
            return redirect()->to('/');
        }
    }


    // --------------------------------- STOK BUKU MASUK -----------------------------------------


    public function menu_stok($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            // Mengambil data buku masuk berdasarkan id buku
            $data['jojo'] = $model->getBukuMasukById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok Buku';
            $data['desc'] = 'Anda dapat melihat Stok Buku di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok Buku';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/menu_stok', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function info_stok_masuk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            // Mengambil data buku masuk berdasarkan id buku
            $data['jojo'] = $model->getBukuMasukById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok Buku Masuk';
            $data['desc'] = 'Anda dapat melihat Stok Buku Masuk di Menu ini.';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/view_stok_masuk', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function add_stok_masuk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            $where=array('id_buku'=>$id);
            $data['jojo']=$model->getWhere('buku',$where);

            $data['title'] = 'Data Stok Buku Masuk';
            $data['desc'] = 'Anda dapat menambah Stok Buku Masuk di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok Buku Masuk';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/add_stok_masuk', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_add_stok_masuk()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('id');
            $b = $this->request->getPost('stok_buku');

            // Data yang akan disimpan
            $data1 = array(
                'buku' => $a,
                'stok_buku_masuk' => $b,
            );

            // Simpan data ke dalam database
            $model = new M_buku();
            $model->simpan('buku_masuk', $data1);

            return redirect()->to('buku/info_stok_masuk/' . $a);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete_stok_masuk($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_buku();

        // Mengambil ID buku terkait dari stok buku masuk yang akan dihapus
            $stok_masuk = $model->getBukuMasukByIdBukuMasuk($id);
            $id_buku = $stok_masuk->buku;

        // Membuat kondisi untuk menghapus stok buku masuk
            $where = array('id_buku_masuk' => $id);
            $model->hapus('buku_masuk', $where);

        // Mengarahkan kembali ke halaman info_stok dengan ID buku yang diperoleh sebelumnya
            // return redirect()->to('buku');
            return redirect()->to('buku/info_stok_masuk/' . $id_buku);
        } else {
            return redirect()->to('/');
        }
    }

    // ---------------------------------- STOK BUKU KELUAR ---------------------------------------

    public function info_stok_keluar($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            // Mengambil data buku masuk berdasarkan id buku
            $data['jojo'] = $model->getBukuKeluarById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Stok Buku Keluar';
            $data['desc'] = 'Anda dapat melihat Stok Buku Keluar di Menu ini.';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/view_stok_keluar', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function add_stok_keluar($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_buku();

            $where=array('id_buku'=>$id);
            $data['jojo']=$model->getWhere('buku',$where);

            $data['title'] = 'Data Stok Buku Keluar';
            $data['desc'] = 'Anda dapat menambah Stok Buku Keluar di Menu ini.';      
            $data['subtitle'] = 'Tambah Stok Buku Keluar';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/buku/add_stok_keluar', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_add_stok_keluar()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('id');
            $b = $this->request->getPost('stok_buku');

            // Data yang akan disimpan
            $data1 = array(
                'buku' => $a,
                'stok_buku_keluar' => $b,
            );

            // Simpan data ke dalam database
            $model = new M_buku();
            $model->simpan('buku_keluar', $data1);

            return redirect()->to('buku/info_stok_keluar/' . $a);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete_stok_keluar($id)
    { 
     if (session()->get('level') == 1 || session()->get('level') == 2) {
        $model = new M_buku();

        // Mengambil ID buku terkait dari stok buku masuk yang akan dihapus
        $stok_keluar = $model->getBukuMasukByIdBukuKeluar($id);
        $id_buku = $stok_keluar->buku;

        // Membuat kondisi untuk menghapus stok buku masuk
        $where = array('id_buku_keluar' => $id);
        $model->hapus('buku_keluar', $where);

        // Mengarahkan kembali ke halaman info_stok dengan ID buku yang diperoleh sebelumnya
            // return redirect()->to('buku');
        return redirect()->to('buku/info_stok_keluar/' . $id_buku);
    } else {
        return redirect()->to('/');
    }
}

    // -------------------------------------- PEMINJAM --------------------------------------------

public function peminjam()
{
    if (session()->get('level') == 3) {
        $model = new M_buku(); // Gunakan model M_buku

        $idUser = session()->get('id');

        $on = 'buku.kategori_buku=kategori_buku.id_kategori';
        $data['jojo'] = $model->join2('buku', 'kategori_buku', $on); // Ubah cara Anda mengambil data sesuai kebutuhan

        // Tambahkan informasi apakah buku disukai atau tidak ke dalam data yang akan dikirimkan ke view
        foreach ($data['jojo'] as $riz) {
            $riz->isLiked = $model->isLiked($riz->id_buku, $idUser);
        }

        $data['title'] = 'Data Buku';
        $data['desc'] = 'Anda dapat melihat Data Buku di Menu ini.';

        echo view('hopeui/partial/header', $data);
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu');
        echo view('hopeui/buku/view_peminjam', $data);
        echo view('hopeui/partial/footer');
    } else {
        return redirect()->to('/');
    }
}

public function aksi_tambah_koleksi($id)
{ 
    if(session()->get('level') == 3) {
        $model = new M_buku();

        $idUser = session()->get('id');

            // Periksa apakah buku sudah ada dalam koleksi pengguna atau belum
        if (!$model->isLiked($id, $idUser)) {
            // Jika belum, tambahkan buku ke dalam koleksi
            $data1 = array(
                'buku' => $id,
                'user' => $idUser
            );
            $model->simpan('koleksi_buku', $data1);
        } else {
            // Jika sudah, hapus buku dari koleksi
            $model->hapusLike($id, $idUser);
        }

        // Arahkan pengguna kembali ke halaman koleksi buku
        return redirect()->to('buku/peminjam');
    } else {
        return redirect()->to('/');
    }
}
}