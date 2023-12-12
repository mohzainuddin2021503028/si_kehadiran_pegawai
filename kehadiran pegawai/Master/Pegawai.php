<?php 

namespace Master;

use Config\Query_builder;

class Pegawai
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('pegawai ')->get()->resultArray();
        $res = '<a href="?target=pegawai&act=tambah_pegawai" class="btn btn-info btn-sm">Tambah pegawai</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>JABATAN</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                <td width="10">'.$no.'</td>
                <td width="100">'.$r['nip'].'</td>
                <td>'.$r['nama'].'</td>
                <td>'.$r['jabatan'].'</td>
                <td width="150">
                    <a href="?target=pegawai&act=edit_pegawai&id='.$r['nip'].'" class="btn btn-success btn-sm">Edit</a>
                    <a href="?target=pegawai&act=delete_pegawai&id='.$r['nip'].'" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
                $no++;
            }
            $res .='</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=pegawai" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pegawai&act=simpan_pegawai">
            <div class="mb-3">
                <label for="nip" class="form-label">nip</label>
                <input type="text" class="form-control" id="nip" name="nip">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
            <label for="jabatan" class="form-label">jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan">
        </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan(){
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        

        $data = array(
            'nip' => $nip,
            'nama' => $nama,
            'jabatan' => $jabatan
        );
        return $this->db->table('pegawai')->insert($data);
    }
    public function edit($id)
    {
        // get data pegawai
        $r = $this->db->table('pegawai')->where("nip='$id'")->get()->rowArray();
        // cek radio

        $res = '<a href="?target=pegawai" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pegawai&act=update_pegawai">
            <input type="hidden" class="form-control" id="param" name="param" value="'.$r['nip'].'">
            
            <div class="mb-3">
                <label for="nip" class="form-label">nip</label>
                <input type="text" class="form-control" id="nip" name="nip" value="'.$r['nip'].'">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="'.$r['nama'].'">
            </div>
            <div class="mb-3">
            <label for="jabatan" class="form-label">jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="'.$r['jabatan'].'">
        </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>';
        return $res;
    }

    public function cekRadio($val, $val2) {
        if($val==$val2) {
            return "checked";
        }
        return "";
    }

    public function update() {
        $param = $_POST['param'];
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];

        $data = array(
            'nip' => $nip,
            'nama' => $nama,
            'jabatan' => $jabatan
        );
        return $this->db->table('pegawai')->where(" nip='$param'")->update($data);
    }

    public function delete($id) {
        return $this->db->table(' pegawai ')->where(" nip='$id' ")->delete();
    }
}