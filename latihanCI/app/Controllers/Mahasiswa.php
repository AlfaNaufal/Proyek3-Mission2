<?php 

namespace App\Controllers;
// use CodeIgniter\Controller;
use App\Models\MahasiswaModel;

    class Mahasiswa extends BaseController{

        public function index(){
            $mhs = new MahasiswaModel;
            $mahasiswa['title']     = 'Data Mahasiswa';
            $mahasiswa['getMahasiswa'] = $mhs->getMahasiswa();
            return view('mahasiswa',$mahasiswa);
        }

        public function cari(){
            $keyword = $this->request->getGet('keyword'); // Ambil input keyword dari form GET
            $model = new MahasiswaModel();
            // $data['getMahasiswa'] = $model->searchByName($keyword);

            if ($keyword) {
                $data['getMahasiswa'] = $model->like('nama', $keyword)->findAll();
            } else {
                $data['getMahasiswa'] = $model->findAll();
            }

            $data['title'] = 'Hasil Pencarian Mahasiswa';
            $data['keyword'] = $keyword;

            return view('mahasiswa', $data);
        }

        public function detail($id){
            $model = new MahasiswaModel;
            $data['mahasiswa'] = $model->find($id);

            // Cek jika data tidak ditemukan
            if (empty($data['mahasiswa'])) {
                // Tampilkan halaman error 404 bawaan CodeIgniter
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Mahasiswa dengan ID ' . $id . ' tidak ditemukan');
            }
            $data['title'] = 'Detail Mahasiswa: ' . $data['mahasiswa']['nama'];
            return view('detail', $data);
        }
        
        public function tambah(){
            return view('insert');
        }

        public function edit($id){
            $model = new MahasiswaModel;
            $getMahasiswa = $model->find($id);
            if(isset($getMahasiswa))
            {
                $data['mahasiswa'] = $getMahasiswa;
                // $data['title']  = 'Edit '.$getMahasiswa->nama;
                return view('edit', $data);
            }else{
                return redirect()->to(base_url('/'))->with('error', "ID Mahasiswa {$id} Tidak Ditemukan");
            }
        }

        public function update(){
            $model = new MahasiswaModel;
            $id = $this->request->getPost('id');
            $data = [
                'nim'   => $this->request->getPost('nim'),
                'nama'  => $this->request->getPost('nama'),
                'umur'  => $this->request->getPost('umur')
            ];
            $model->editMahasiswa($data,$id);
            return redirect()->to(base_url('/'))->with('success', 'Data berhasil diperbarui.');
        }

        public function add(){
            $model = new MahasiswaModel;
            $data = [
                'nim'  => $this->request->getPost('nim'),
                'nama' => $this->request->getPost('nama'),
                'umur' => $this->request->getPost('umur')
            ];
            $model->insert($data);
            return redirect()->to(base_url('/'))->with('success', 'Data berhasil ditambahkan.');
        }

        public function hapus($id){
            $model = new MahasiswaModel;
            $getMahasiswa = $model->find($id);
            if(isset($getMahasiswa))
            {
                $model->delete($id);
                return '<script>
                        alert("Data berhasil Di Hapus");
                        window.location="'.base_url('/').'"
                    </script>';
            }else{
                return redirect()->to(base_url('/'))->with('error', 'Hapus Gagal !, ID barang '.$id.' Tidak ditemukan');
            }
        }
    }