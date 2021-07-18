<?php

namespace App\Controllers;

use App\Models\katalogModel;
use App\Models\dipinjamModel;

class Katalog extends BaseController
{
	protected $katalogModel;
	protected $dipinjamModel;
	public function __construct()
	{
		$this->katalogModel = new katalogModel();
		$this->bukuDipinjamMmode = new dipinjamModel();
	}

	public function buku()
	{
		$data = [
			'katalog' =>  $this->katalogModel->findAll(),
			'title' => 'Katalog Buku'
		];
		return view('katalog/buku', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Tambah Katalog Baru',
			'validation' => \Config\Services::validation()
		];
		return view('katalog/create', $data);
	}

	public function save()
	{
		//validasi
		if (!$this->validate([
			'judul' => [
				'rules' => 'required|is_unique[katalog_buku.judul]',
				'errors' => [
					'required' => '{field} katalog harus diisi',
					'is_unique' => '{field} katalog sudah ada'
				]
			],
			'sampul' => [
				'rules' => 'max_size[sampul,1024]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'Ukuran gambar lebih dari 2MB',
					'mime_in' => 'Yang Anda upload bukan gambar'
				]
			]
		])) {
			// $validation = \Config\Services::validation();
			return redirect()->to('/katalog/create')->withInput();
		}
		//ambil gambar yang diupload users
		$fileSampul = $this->request->getFile('sampul');

		if ($fileSampul->getError() == 4) {
			$namaSampul = 'unnamed.png';
		} else {
			$namaSampul = $fileSampul->getRandomName();
			$fileSampul->move('img', $namaSampul);
		}


		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->katalogModel->save([
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getVar('penulis'),
			'penerbit' => $this->request->getVar('penerbit'),
			'sampul' => $namaSampul
		]);

		//buat flash data
		session()->setFlashdata('pesan', 'Katalog baru berhasil ditambahkan');

		return redirect()->to('/')->withInput();
	}

	public function edit($slug)
	{
		$data = [
			'title' => 'Tambah Katalog Baru',
			'validation' => \Config\Services::validation(),
			'katalog' => $this->katalogModel->getkatalog($slug)
		];
		return view('katalog/edit', $data);
	}

	public function update($id)
	{
		//cek judul diganti atau tidak
		$katalogLama = $this->katalogModel->getkatalog($this->request->getVar('slug'));
		if ($katalogLama['judul'] == $this->request->getVar('judul')) {
			$rule_judul = 'required';
		} else {
			$rule_judul = 'required|is_unique[katalog_buku.judul]';
		}
		//validasi judul
		if (!$this->validate([
			'judul' => [
				'rules' => $rule_judul,
				'errors' => [
					'required' => '{field} katalog harus diisi',
					'is_unique' => '{field} katalog sudah ada'
				]
			],
			'sampul' => [
				'rules' => 'max_size[sampul,1024]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'Ukuran gambar lebih dari 2MB',
					'mime_in' => 'Yang Anda upload bukan gambar'
				]
			]
		])) {
			return redirect()->to('/katalog/edit/' . $this->request->getVar('slug'))->withInput();
		}

		$fileSampul = $this->request->getFile('sampul');

		// cek gambar, apakah tetap gambar lama
		if ($fileSampul->getError() == 4) {
			$namaSampul = $this->request->getVar('sampulLama');
		} else {
			//generate nama file random
			$namaSampul = $fileSampul->getRandomName();

			//pindahkan gambar
			$fileSampul->move('img', $namaSampul);

			//hapus file yang lama
			unlink('img/' . $this->request->getVar('sampulLama'));
		}

		$slug = url_title($this->request->getVar('judul'), '-', true);
		$this->katalogModel->save([
			'id' => $id,
			'judul' => $this->request->getVar('judul'),
			'slug' => $slug,
			'penulis' => $this->request->getVar('penulis'),
			'penerbit' => $this->request->getVar('penerbit'),
			'sampul' => $namaSampul
		]);
		session()->setFlashdata('pesan', 'Data berhsail diubah');
		return redirect()->to('/katalog/buku');
	}

	public function delete($id)
	{
		//cara nama file berdasarkan id
		$buku = $this->katalogModel->find($id);

		//file difault jangan dihapus
		if ($buku['sampul'] != 'unnamed.png') {

			//hapus file di serve
			unlink('img/' . $buku['sampul']);
		}


		$this->katalogModel->delete($id);
		session()->setFlashdata('pesan', 'Buku berhasil dihapus');
		return redirect()->to('/katalog/buku');
	}

	//Buku yang dipinjam
	public function dipinjam()
	{
		$dipinjam = $this->dipinjamModel->countAllResults();
		$data = [
			'title' => 'Dipinjam',
			'dipinjam' => $dipinjam
		];
		return view('katalog/dipinjam', $data);
	}

	//--------------------------------------------------------------------

}
