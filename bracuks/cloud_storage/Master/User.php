<?php 

namespace Master;

use Config\Query_builder;

class User
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('user')->get()->resultArray();
        $res = '<a href="?target=user&act=tambah_user" class="btn btn-info btn-sm">Tambah User</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>id_user</th>
                    <th>nama_user</th>
                    <th>email</th>
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
                <td width="100">'.$r['nama_user'].'</td>
                <td>'.$r['email'].'</td>
                <td width="10">'.$r['username'].'</td>
                <td width="10">'.$r['password'].'</td>
                <td width="150">
                    <a href="?target=user&act=edit_user&id_user='.$r['id_user'].'" class="btn btn-success btn-sm">Edit</a>
                    <a href="?target=user&act=delete_user&id_user='.$r['id_user'].'" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
                $no++;
            }
            $res .='</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=user" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=user&act=simpan_user">
            <div class="mb-3">
                <label for="nama_user" class="form-label">nama user</label>
                <input type="text" class="form-control" id="nama_user" name="nama_user">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">username</label><br>
                <input type="text" class="form-control" "name="username" id="username">
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label><br>
                <input type="text" class="form-control" "name="password" id="password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan(){
        $nama_user = $_POST['nama_user'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data = array(
            'nama_user' => $nama_user,
            'email' => $email,
            'username' => $username,
            'password' => $password,
        );
        return $this->db->table('user')->insert($data);
    }
    public function edit($id_user)
    {
        // get data user
        $r = $this->db->table('user')->where("id_user='$id_user'")->get()->rowArray();
        // cek radio

        $res = '<a href="?target=user" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=user&act=update_user">
            <input type="hidden" class="form-control" id="param" name="param" value="'.$r['id_user'].'">
            
            <div class="mb-3">
                <label for="nama_user" class="form-label">nama user</label>
                <input type="text" class="form-control" id="nama_user" name="nama_user" value="'.$r['nama_user'].'">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" id="email" name="email" value="'.$r['email'].'">
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
        $nama_user = $_POST['nama_user'];
        $email= $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data = array(
            'nama_user' => $nama_user,
            'email' => $email,
            'username' => $username,
            'password' => $password,
        );
        return $this->db->table('user')->where(" id_user='$param'")->update($data);
    }

    public function delete($id_user) {
        return $this->db->table(' user')->where(" id_user='$id_user' ")->delete();
    }
}