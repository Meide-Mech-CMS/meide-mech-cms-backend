<?php

namespace App\Modules\SocialMedia\Controllers;

use App\Modules\SocialMedia\Models\SocialMediaModel;

class SocialMedia extends BaseController
{
    public $sosmedModel;
    public function __construct()
    {
        $this->sosmedModel = new SocialMediaModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Social Media Manager',
            'view' => 'admin/social_media/index',
            'data' => $this->sosmedModel->findAll(),
        ];

        return view('template/dashboard', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Social Media',
            'view' => 'admin/social_media/create',
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function store()
    {
        helper(['form']);

        //validation
        $rules = [
            'url'          => 'required',
            'icon'         => 'uploaded[icon]|mime_in[icon,image/svg,image/svg+xml]',
        ];

        //if invalid
        if (!$this->validate($rules)) {
            // dd(\Config\Services::validation());
            // dd($this->request->getFiles());
            return redirect()->to('/admin/social_media/add')->withInput();
        }

        //save images
        $iconFile = $this->request->getFile('icon');
        //random
        $iconName = $iconFile->getRandomName();
        //move gambar
        $iconFile->move('img', $iconName);

        //setup data to db
        $data = [
            'icon' => $iconName,
            'url'     => $this->request->getVar('url'),
            'status'    => $this->request->getVar('status'),
            'createBy' => session()->get('username'),
            'updateBy' => session()->get('username'),
        ];
        $this->sosmedModel->save($data);
        session()->setFlashdata('msg', 'Social Media Successfully Created');
        return redirect()->to('/admin/social_media');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Social Media',
            'view' => 'admin/social_media/edit',
            'data' => $this->sosmedModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function update($id)
    {
        helper(['form']);

        //validation
        $rules = [
            'url'          => 'required',
            'icon'         => 'mime_in[icon,image/svg,image/svg+xml]',
        ];

        //if invalid
        if (!$this->validate($rules)) {
            return redirect()->to('/admin/social_media/edit/' . $id)->withInput();
        }

        $iconFile = $this->request->getFile('icon');
        if ($iconFile->getError() == 4) {
            $iconName = $this->request->getVar('oldIcon');
        } else {
            //random
            $iconName = $iconFile->getRandomName();
            //move gambar
            $iconFile->move('img', $iconName);
            unlink('img/' . $this->request->getVar('oldIcon'));
        }

        //setup data to db
        $data = [
            'id' => $id,
            'icon' => $iconName,
            'url'     => $this->request->getVar('url'),
            'status'    => $this->request->getVar('status'),
            'updateBy' => session()->get('username'),
        ];
        $this->sosmedModel->save($data);
        session()->setFlashdata('msg', 'Social Media Successfully Updated');
        return redirect()->to('/admin/social_media');
    }

    public function destroy($id)
    {
        $sosmed = $this->sosmedModel->find($id);
        unlink('img/' . $sosmed['icon']);
        $this->sosmedModel->delete($id);
        session()->setFlashdata('msg', 'Social Media Successfully Deleted');
        return redirect()->to('/admin/social_media');
    }

}