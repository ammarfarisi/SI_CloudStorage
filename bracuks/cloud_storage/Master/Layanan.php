<?php 

namespace Master;

use Config\Query_builder;

class Layanan
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('layanan ')->get()->resultArray();
        $res = '<a href="?target=layanan&act=tambah_layanan" class="btn btn-info btn-sm">Tambah layanan</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>id_layanan</th>
                    <th>nama_pelayan</th>
                    <th>jenis_layanan</th>
                    <th>keterangan</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                <td width="10">'.$no.'</td>
                <td width="100">'.$r['nama_pelayan'].'</td>
                <td>'.$r['jenis_pelayanan'].'</td>
                <td width="10">'.$r['keterangan'].'</td>
                <td width="150">
                    <a href="?target=layanan&act=edit_layanan&id_layanan='.$r['id_layanan'].'" class="btn btn-success btn-sm">Edit</a>
                    <a href="?target=layanan&act=delete_layanan&id_layanan='.$r['id_layanan'].'" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
                $no++;
            }
            $res .='</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=layanan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=layanan&act=simpan_layanan">
            <div class="mb-3">
                <label for="nama_pelayan" class="form-label">nama pelayan</label>
                <input type="text" class="form-control" id="nama_pelayan" name="nama_pelayan">
            </div>
            <div class="mb-3">
                <label for="jenis_pelayanan" class="form-label">jenis_pelayanan</label>
                <input type="text" class="form-control" id="jenis_pelayanan" name="jenis_pelayanan">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">keterangan</label><br>
                <input type="text" class="form-control" "name="keterangan" id="keterangan1">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan(){
        $nama_pelayan = $_POST['nama_pelayan'];
        $jenis_pelayanan = $_POST['jenis_pelayanan'];
        $keterangan = $_POST['keterangan'];

        $data = array(
            'nama_pelayan' => $nama_pelayan,
            'jenis_pelayanan' => $jenis_pelayanan,
            'keterangan' => $keterangan,
        );
        return $this->db->table('layanan')->insert($data);
    }
    public function edit($id_layanan)
    {
        // get data layanan
        $r = $this->db->table('layanan')->where("id_layanan='$id_layanan'")->get()->rowArray();
        // cek radio

        $res = '<a href="?target=layanan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=layanan&act=update_layanan">
            <input type="hidden" class="form-control" id="param" name="param" value="'.$r['id_layanan'].'">
            
            <div class="mb-3">
                <label for="nama_pelayan" class="form-label">nama pelayan</label>
                <input type="text" class="form-control" id="nama_pelayan" name="nama_pelayan" value="'.$r['nama_pelayan'].'">
            </div>
            <div class="mb-3">
                <label for="jenis_pelayanan" class="form-label">jenis pelayanan</label>
                <input type="text" class="form-control" id="jenis_pelayanan" name="jenis_pelayanan" value="'.$r['jenis_pelayanan'].'">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="'.$r['keterangan'].'">
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
        $nama_pelayan = $_POST['nama_pelayan'];
        $jenis_pelayanan = $_POST['jenis_pelayanan'];
        $keterangan = $_POST['keterangan'];

        $data = array(
            'nama_pelayan' => $nama_pelayan,
            'jenis_pelayanan' => $jenis_pelayanan,
            'keterangan' =>$keterangan,
        );
        return $this->db->table('layanan')->where(" id_layanan='$param'")->update($data);
    }

    public function delete($id_layanan) {
        return $this->db->table(' layanan ')->where(" id_layanan='$id_layanan' ")->delete();
    }
}