<?php 

namespace Master;

use Config\Query_builder;

class Status
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('status ')->get()->resultArray();
        $res = '<a href="?target=status&act=tambah_status" class="btn btn-info btn-sm">Tambah status</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>id_status</th>
                    <th>nama_status</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                <td width="10">'.$no.'</td>
                <td width="100">'.$r['id_status'].'</td>
                <td>'.$r['nama_status'].'</td>
                <td width="150">
                    <a href="?target=status&act=edit_status&id='.$r['id_status'].'" class="btn btn-success btn-sm">Edit</a>
                    <a href="?target=status&act=delete_status&id='.$r['id_status'].'" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
                $no++;
            }
            $res .='</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=status" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=status&act=simpan_status">
            <div class="mb-3">
                <label for="id_status" class="form-label">id_status</label>
                <input type="text" class="form-control" id="id_status" name="id_status">
            </div>
            <div class="mb-3">
                <label for="nama_status" class="form-label">nama_status</label>
                <input type="text" class="form-control" id="nama_status" name="nama_status">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan(){
        $id_status = $_POST['id_status'];
        $nama_status = $_POST['nama_status'];

        $data = array(
            'id_status' => $id_status,
            'nama_status' => $nama_status,
        );
        return $this->db->table('status')->insert($data);
    }
    public function edit($id)
    {
        // get data status
        $r = $this->db->table('status')->where("id_status='$id'")->get()->rowArray();
        // cek radio

        $res = '<a href="?target=status" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=status&act=update_status">
            <input type="hidden" class="form-control" id="param" name="param" value="'.$r['id_status'].'">
            
            <div class="mb-3">
                <label for="id_status" class="form-label">id_status</label>
                <input type="text" class="form-control" id="id_status" name="id_status" value="'.$r['id_status'].'">
            </div>
            <div class="mb-3">
                <label for="nama_status" class="form-label">nama_status</label>
                <input type="text" class="form-control" id="nama_status" name="nama_status" value="'.$r['nama_status'].'">
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
        $id_status = $_POST['id_status'];
        $nama_status = $_POST['nama_status'];

        $data = array(
            'id_status' => $id_status,
            'nama_status' => $nama_status,
        );
        return $this->db->table('status')->where(" id_status='$param'")->update($data);
    }

    public function delete($id) {
        return $this->db->table(' status ')->where(" id_status='$id' ")->delete();
    }
}