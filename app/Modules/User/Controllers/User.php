<?php

namespace App\Modules\User\Controllers;

use App\Modules\User\Models\UserModel;
use CodeIgniter\Controller;

class User extends BaseController
{
    public $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel;
    }
    public function index()
    {
        $data = [
            'title' => 'User Manager',
            'view' => 'admin/user/index',
            'data' => $this->userModel->findAll(),
        ];

        return view('template/dashboard', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add User',
            'view' => 'admin/user/create',
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function store()
    {
        helper(['form']);

        //validation
        $rules = [
            'full_name'          => 'required',
            'username'          => 'required|min_length[2]|max_length[50]|is_unique[user.username]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'password_confirm'  => 'matches[password]',
            'role' => 'required',
            'images' => 'is_image[images]|mime_in[images,image/jpg,image/png,image/jpeg]'
        ];

        //if invalid
        if (!$this->validate($rules)) {
            // dd(\Config\Services::validation());
            return redirect()->to('/admin/user/add')->withInput();
        }


        //save images
        $imgFile = $this->request->getFile('images');
        if ($imgFile->getError() == 4) {
            $imgName = 'default.png';
        } else {
            //random
            $imgName = $imgFile->getRandomName();
            //move gambar
            $imgFile->move('img', $imgName);
        }

        //setup data to db
        $data = [
            'full_name'     => $this->request->getVar('full_name'),
            'username'     => $this->request->getVar('username'),
            'email'     => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'uuid'     => rand(10000000, 99999999),
            'is_online'    => 0,
            'status'    => $this->request->getVar('status'),
            'rules'     => $this->request->getVar('role'),
            'images' => $imgName,
            'thumbnail_images' => $imgName,
            'createBy' => session()->get('username'),
            'updateBy' => session()->get('username'),
        ];
        $this->userModel->save($data);
        session()->setFlashdata('msg', 'User Successfully Created');
        return redirect()->to('/admin/user');
    }

    public function edit($uuid)
    {
        $data = [
            'title' => 'Edit User',
            'view' => 'admin/user/edit',
            'data' => $this->userModel->where(['uuid' => $uuid])->first(),
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function update($uuid)
    {
        helper(['form']);

        //get data user from db
        $dataUser = $this->userModel->where(['uuid' => $uuid])->first();

        $password = $dataUser['password'];
        $newPassword = $this->request->getVar('password');
        if ($newPassword != null) {
            $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        if ($dataUser['username'] == $this->request->getVar('username')) {
            $rule_username = 'required';
        } else {
            $rule_username = 'required|min_length[2]|max_length[50]|is_unique[user.username]';
        }

        if ($dataUser['email'] == $this->request->getVar('email')) {
            $rule_email = 'required';
        } else {
            $rule_email = 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]';
        }

        //validation
        $rules = [
            'full_name'          => 'required',
            'username'          => $rule_username,
            'email'         => $rule_email,
            'password'      => 'min_length[0]|max_length[50]',
            'password_confirm'  => 'matches[password]',
            'role' => 'required',
            'images' => 'is_image[images]|mime_in[images,image/jpg,image/png,image/jpeg]'
        ];

        //if invalid
        if (!$this->validate($rules)) {
            // dd(\Config\Services::validation());
            // dd($rules);
            return redirect()->to('/admin/user/edit/' . $uuid)->withInput();
        }

        //save images
        $imgFile = $this->request->getFile('images');
        if ($imgFile->getError() == 4) {
            $imgName = $dataUser['images'];
        } else {
            //random
            $imgName = $imgFile->getRandomName();
            //move gambar
            $imgFile->move('img', $imgName);
            if ($dataUser['images'] != 'default.png') {
                unlink('img/' . $dataUser['images']);
            }
        }

        //setup data to db
        $data = [
            'id' => $dataUser['id'],
            'full_name'     => $this->request->getVar('full_name'),
            'username'     => $this->request->getVar('username'),
            'email'     => $this->request->getVar('email'),
            'password' => $password,
            'uuid'     => rand(10000000, 99999999),
            'is_online'    => 0,
            'status'    => $this->request->getVar('status'),
            'rules'     => $this->request->getVar('role'),
            'images' => $imgName,
            'thumbnail_images' => $imgName,
            'createBy' => session()->get('username'),
            'updateBy' => session()->get('username'),
        ];
        $this->userModel->save($data);
        session()->setFlashdata('msg', 'User Successfully Updated');
        return redirect()->to('/admin/user');
    }
    public function destroy($id)
    {
        $user = $this->userModel->find($id);
        if ($user['images'] != 'default.png') {
            unlink('img/' . $user['images']);
        }
        $this->userModel->delete($id);
        session()->setFlashdata('msg', 'User Successfully Deleted');
        return redirect()->to('/admin/user');
    }

    public function getAll()
    {
        $data = $this->this->userModel->findAll();
        return $this->response->setJSON($data);
    }

    public function getOne($id)
    {
        $data = $this->sosmedModel->find($id);
        return $this->response->setJSON($data);
    }

}