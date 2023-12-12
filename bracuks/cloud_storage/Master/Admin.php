<?php 

namespace Master;

use Config\Query_builder;

class Admin
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('admin ')->get()->resultArray();
        $res = '<a href="?target=admin&act=tambah_admin" class="btn btn-info btn-sm">Tambah admin</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>id_admin</th>
                    <th>nama_admin</th>
                    <th>username</th>
                    <th>password</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                <td width="10">'.$no.'</td>
                <td width="100">'.$r['nama_admin'].'</td>
                <td>'.$r['username'].'</td>
                <td width="10">'.$r['password'].'</td>
                <td width="150">
                    <a href="?target=admin&act=edit_admin&id_admin='.$r['id_admin'].'" class="btn btn-success btn-sm">Edit</a>
                    <a href="?target=admin&act=delete_admin&id_admin='.$r['id_admin'].'" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
                $no++;
            }
            $res .='</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=admin&act=simpan_admin">
            <div class="mb-3">
                <label for="nama_admin" class="form-label">nama admin</label>
                <input type="text" class="form-control" id="nama_admin" name="nama_admin">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label><br>
                <input type="text" class="form-control" "name="password" id="password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan(){
        $nama_admin = $_POST['nama_admin'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data = array(
            'nama_admin' => $nama_admin,
            'username' => $username,
            'password' => $password,
        );
        return $this->db->table('admin')->insert($data);
    }
    public function edit($id_admin)
    {
        // get data admin
        $r = $this->db->table('admin')->where("id_admin='$id_admin'")->get()->rowArray();
        // cek radio

        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=admin&act=update_admin">
            <input type="hidden" class="form-control" id="param" name="param" value="'.$r['id_admin'].'">
            
            <div class="mb-3">
                <label for="nama_admin" class="form-label">nama admin</label>
                <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="'.$r['nama_admin'].'">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username" value="'.$r['username'].'">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="text" class="form-control" id="password" name="password" value="'.$r['password'].'">
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
        $nama_admin = $_POST['nama_admin'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data = array(
            'nama_admin' => $nama_admin,
            'username' => $username,
            'password' =>$password,
        );
        return $this->db->table('admin')->where(" id_admin='$param'")->update($data);
    }

    public function delete($id_admin) {
        return $this->db->table(' admin ')->where(" id_admin='$id_admin' ")->delete();
    }
}