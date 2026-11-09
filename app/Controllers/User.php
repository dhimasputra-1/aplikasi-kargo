<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Group;
use App\Models\ModelUser;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use Myth\Auth\Models\LoginModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Entities\User as EntitiesUser;
use Myth\Auth\Password;




class User extends BaseController
{
    public function index()
    {
        $title = [
            'title' => 'User'
        ];
        return view('users/datausers', $title);
    }

    public function view()
    {
        $db = db_connect();
        $user = $db
        ->table('users')
        ->select('fullname, username, email, auth_groups.id as group_id, users.active as aktif, users.id as iduser')
        ->join('auth_groups_users','user_id = users.id')
        ->join('auth_groups', 'group_id = auth_groups.id');
        return DataTable::of($user)
            ->edit('aktif', function ($row) {
                return ($row->aktif == 1) ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>';
            })
            ->edit('group_id', function ($row) {
                 if($row->group_id == 1){
                    return '<span class="badge bg-success">Karyawan</span>';
                } else if ($row->group_id == 2) {
                    return '<span class="badge bg-primary">Pimpinan</span>';
                } else{
                    return '<span class="badge bg-info">User</span>';
                }
                
            })
            ->add('action', function ($row) {
                $button1 = '<button type="button" class="btn btn-primary btn-sm btn-detail" data-iduser="' . $row->iduser . '" style="margin-left: 5px;"><i class="fas fa-eye"></i></button>';
                $button2 = '<button type="button" class="btn btn-secondary btn-sm btn-edit" data-iduser="' . $row->iduser . '" style="margin-left: 5px;"><i class="fas fa-pencil-alt"></i></button>';
                $button3 = '<button type="button" class="btn btn-danger btn-sm btn-delete" data-iduser="' . $row->iduser . '" style="margin-left: 5px;"><i class="fas fa-trash"></i></button>';
                $buttonsGroup = '<div style="display: flex;">' . $button1 . $button2 . $button3 . '</div>';
                return $buttonsGroup;
            }, 'last')
            ->addNumbering()
            ->hide('iduser')
            ->toJson();
    }
    public function detail($user_id = null)
    {
        $db = db_connect();
        $userQuery = $db
            ->table('users')
            ->select('fullname, username, users.email, auth_groups.id as group_id, users.active as aktif, foto, name')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'group_id = auth_groups.id')
            ->join('auth_logins', 'users.id = auth_logins.user_id')
            ->where('users.id', $user_id);
        $user = $userQuery->get();

        $userData = $user->getRow();

        $loginModel = new \App\Models\LoginSession();
        $loginData = [
            'login' => $loginModel->where('user_id', $user_id)->orderBy('date','Desc')->paginate(10),
            'pager' => $loginModel->pager,
        ];

        if (!$userData) {
            return redirect()->back();
        }

        $data = [
            'users' => $userData,
            'login' => $loginData['login'],
            'pager' => $loginData['pager'],
        ];

        return view('users/detailusers', $data);
    }


  
    public function tambah()
    {
        $title = [
            'title' => 'Tambah User'
        ];
        return view('users/formtambah', $title);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $fullname = $this->request->getPost('fullname');
            $email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $cover = $this->request->getFile('cover');
            $rules = $this->validate([

                'fullname' => [
                    'label' => 'Nama Lengakap',
                    'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'alpha_numeric_space' => '{field} hanya boleh huruf, angka, dan spasi',
                        'min_length' => '{field} minimal 3 karakter',
                        'max_length' => '{field} maximal 30 karakter'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'valid_email' => '{field} tidak valid',
                        'is_unique' => '{field} sudah digunakan! silahkan pakai yang lain'
                    ]
                ],
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 3 karakter',
                        'max_length' => '{field} maximal 30 karakter',
                        'is_unique' => '{field} sudah digunakan! silahkan pakai yang lain'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|strong_password',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'role' => [
                    'label' => 'Role',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],

                'cover' => [
                    'label' => 'Foto',
                    'rules' => 'mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]|max_size[cover,4096]',
                    'errors' => [
                        'mime_in' => 'File harus berformat jpg, jpeg, atau png',
                        'max_size' => 'Ukuran file maksimal adalah 4MB'
                    ]
                ],
            ]);

            if (!$rules) {
                $validation = \Config\Services::validation();
                $error = [
                    'error_fullname' => $validation->getError('fullname'),
                    'error_email' => $validation->getError('email'),
                    'error_username' => $validation->getError('username'),
                    'error_password' => $validation->getError('password'),
                    'error_role' => $validation->getError('role'),
                    'error_cover' => $validation->getError('cover'),
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                if ($cover->isValid() && !$cover->hasMoved()) {
                    $newName = 'foto-' . date('Ymd') . '-' . $username . '.' . $cover->getClientExtension();
                    $cover->move('assets/img', $newName);

                    $user = new EntitiesUser();
                    $user->fill([
                        'fullname' => $fullname,
                        'username' => $username,
                        'email' => $email,
                        'password_hash' => Password::hash($password),
                        'activate_hash' => bin2hex(random_bytes(16)),
                        'active' => true,
                        'foto' => $newName,
                    ]);
                    $modelUser = new UserModel();
                    $modelUser->save($user);
                    $iduser = $modelUser->getInsertID();
                    $role = $this->request->getPost('role');
                    $groupModel = new \Myth\Auth\Models\GroupModel();
                    $groupModel->addUserToGroup($iduser, $role);
                    $json = [
                        'sukses' => 'Berhasil Simpan Data'
                    ];
                } else {
                    $json = [
                        'error' => ['foto' => $cover->getErrorString() . '(' . $cover->getError() . ')']
                    ];
                }
                
            }
            echo json_encode($json);
        }
    }

    public function formedit($iduser)
    {
      
        $modelUser = new UserModel();
        $user = $modelUser->select('users.*, auth_groups_users.group_id')
                           ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                           ->find($iduser);
        $data = [
            'title' => 'Edit User',
            'users' => $user
        ];
        return view('users/formedit', $data);
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getPost('iduser');
            $fullname = $this->request->getPost('fullname');
            $email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $cover = $this->request->getFile('cover');
            $rules = $this->validate([

                'fullname' => [
                    'label' => 'Nama Lengakap',
                    'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'alpha_numeric_space' => '{field} hanya boleh huruf, angka, dan spasi',
                        'min_length' => '{field} minimal 3 karakter',
                        'max_length' => '{field} maximal 30 karakter'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'valid_email' => '{field} tidak valid',
                    ]
                ],
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 3 karakter',
                        'max_length' => '{field} maximal 30 karakter',
                    ]
                ],
                
                'role' => [
                    'label' => 'Role',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],

                'cover' => [
                    'label' => 'Foto',
                    'rules' => 'mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]|max_size[cover,4096]',
                    'errors' => [
                        'mime_in' => 'File harus berformat jpg, jpeg, atau png',
                        'max_size' => 'Ukuran file maksimal adalah 4MB'
                    ]
                ],
            ]);

            if (!$rules) {
                $validation = \Config\Services::validation();
                $error = [
                    'error_fullname' => $validation->getError('fullname'),
                    'error_email' => $validation->getError('email'),
                    'error_username' => $validation->getError('username'),
                    'error_password' => $validation->getError('password'),
                    'error_role' => $validation->getError('role'),
                    'error_cover' => $validation->getError('cover'),
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                if ($cover->isValid() && !$cover->hasMoved()) {
                    $newName = 'foto-' . date('Ymd') . '-' . $username . '.' . $cover->getClientExtension();
                    $cover->move('assets/img', $newName);

                    $model = new UserModel(); 
                    $existingUser = $model->where('id', $iduser)->first();

                    if ($existingUser->foto != $newName) {
                        unlink('assets/img/' . $existingUser->foto);
                    }

                    $user = new EntitiesUser();
                    $user->fill([
                        'fullname' => $fullname,
                        'username' => $username,
                        'email' => $email,
                        'password_hash' => Password::hash($password),
                        'activate_hash' => bin2hex(random_bytes(16)),
                        'active' => true,
                        'foto' => $newName,
                    ]);
                    $modelUser = new ModelUser();
                    $modelUser->update($iduser, $user);
                    
                    $role = $this->request->getPost('role');
                    $groupModel = new Group();
                    $groupModel->where('user_id', $iduser)->set(['group_id' => $role])->update();
                    $json = [
                        'sukses' => 'Data berhasil diupdate'
                    ];
                } else {
                    $model = new UserModel();
                    $existingUser = $model->where('id', $iduser)->first();
                    $user = new EntitiesUser();
                    $user->fill([
                        'fullname' => $fullname,
                        'username' => $username,
                        'email' => $email,
                        'password_hash' => Password::hash($password),
                        'activate_hash' => bin2hex(random_bytes(16)),
                        'active' => true,
                        'foto' => $existingUser->foto,
                    ]);
                    $modelUser = new ModelUser();
                    $modelUser->update($iduser, $user);

                    $role = $this->request->getPost('role');
                    $groupModel = new Group();
                    $groupModel->where('user_id', $iduser)->set(['group_id' => $role])->update();
                    $json = [
                        'sukses' => 'Data berhasil diupdate'
                    ];
                }
            }
            echo json_encode($json);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $iduser = $this->request->getPost('iduser');

            $model = new ModelUser();
            $model->where('id', $iduser)->delete();

            $json = [
                'sukses' => 'Data User Berhasil Dihapus'
            ];

            return $this->response->setJSON($json);
        }
    }

}
