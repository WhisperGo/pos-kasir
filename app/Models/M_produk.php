<?php

namespace App\Models;
use CodeIgniter\Model;

class M_produk extends Model
{		
	protected $table      = 'produk';
	protected $primaryKey = 'ProdukID';
	protected $allowedFields = ['NamaProduk', 'Harga', 'Stok'];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;

	public function tampil($table1)	
	{
		return $this->db->table($table1)->where('deleted_at', null)->get()->getResult();
	}
	public function hapus($table, $where)
	{
		return $this->db->table($table)->delete($where);
	}
	public function simpan($table, $data)
	{
		return $this->db->table($table)->insert($data);
	}
	public function qedit($table, $data, $where)
	{
		return $this->db->table($table)->update($data, $where);
	}
	public function getWhere($table, $where)
	{
		return $this->db->table($table)->getWhere($where)->getRow();
	}
	public function getWhere2($table, $where)
	{
		return $this->db->table($table)->getWhere($where)->getRowArray();
	}
	public function join2($table1, $table2, $on)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->where("$table1.deleted_at", null)
		->where("$table2.deleted_at", null)
        ->where("buku.kategori_buku !=", 10) // Menambahkan kondisi kategori_buku != 10
        ->get()
        ->getResult();
    }
    public function join2digital($table1, $table2, $on)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->where("$table1.deleted_at", null)
		->where("$table2.deleted_at", null)
        ->where("buku.kategori_buku =", 10) // Menambahkan kondisi kategori_buku != 10
        ->get()
        ->getResult();
    }



	// ----------------------------------- STOK BUKU MASUK -------------------------------------

    public function getBukuMasukById($id)
    {
    	return $this->db->table('buku_masuk')
    	->select('buku_masuk.*, buku.*') 
    	->join('buku', 'buku.id_buku = buku_masuk.buku')
    	->where('buku.id_buku', $id)
    	->get()
    	->getResult();
    }


    public function getBukuMasukByIdBukuMasuk($id)
    {
        // Query untuk mengambil data stok buku masuk berdasarkan ID
    	$query = $this->db->table('buku_masuk')
    	->where('id_buku_masuk', $id)
    	->get();

        // Mengembalikan satu baris data stok buku masuk
    	return $query->getRow();
    }

	// ------------------------------------- PEMINJAM ---------------------------------------------

    public function isLiked($idBuku, $idUser)
    {
    	return $this->db->table('koleksi_buku')
    	->where(['buku' => $idBuku, 'user' => $idUser])
    	->countAllResults() > 0;
    }

    public function hapusLike($idBuku, $idUser)
    {
    	return $this->db->table('koleksi_buku')
    	->where(['buku' => $idBuku, 'user' => $idUser])
    	->delete();
    }

    public function isLikedByIdUser($idUser)
    {
    	return $this->db->table('koleksi_buku')
    	->select('koleksi_buku.*, buku.*, kategori_buku.*')
    	->join('buku', 'buku.id_buku = koleksi_buku.buku')
    	->join('kategori_buku', 'kategori_buku.id_kategori = buku.kategori_buku')
    	->where('koleksi_buku.user', $idUser)
    	->where('koleksi_buku.deleted_at', null)
    	->get()
    	->getResult();
    }

	//CI4 Model
    public function deletee($id)
    {
    	return $this->delete($id);
    }
}