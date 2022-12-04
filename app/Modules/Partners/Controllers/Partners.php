<?php

namespace App\Modules\Partners\Controllers;

use App\Modules\Partners\Models\PartnersModel;

class Partners extends BaseController
{
    public $partnersModel;
    public function __construct()
    {
        $this->partnersModel = new PartnersModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Partners Manager',
            'view' => 'admin/partners/index',
            'data' => $this->partnersModel->findAll(),
        ];

        return view('template/dashboard', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Partners',
            'view' => 'admin/partners/create',
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function store()
    {
        helper(['form']);

        //validation
        $rules = [
            'images'         => 'uploaded[images]|mime_in[images,image/jpg,image/png,image/jpeg]',
            'link'          => 'required',
        ];

        //if invalid
        if (!$this->validate($rules)) {
            // dd(\Config\Services::validation());
            // dd($this->request->getFiles());
            return redirect()->to('/admin/partners/add')->withInput();
        }

        //save images
        $imagesFile = $this->request->getFile('images');
        //random
        $imagesName = $imagesFile->getRandomName();
        //move gambar
        $imagesFile->move('img', $imagesName);

        //setup data to db
        $data = [
            'images' => $imagesName,
            'link'     => $this->request->getVar('link'),
            'status'    => $this->request->getVar('status'),
            'createBy' => session()->get('username'),
            'updateBy' => session()->get('username'),
        ];
        $this->partnersModel->save($data);
        session()->setFlashdata('msg', 'Partner Successfully Created');
        return redirect()->to('/admin/partners');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Partners',
            'view' => 'admin/partners/edit',
            'data' => $this->partnersModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function update($id)
    {
        helper(['form']);

        //validation
        $rules = [
            'images'         => 'is_image[images]|mime_in[images,image/jpg,image/png,image/jpeg]',
            'link'          => 'required',
        ];

        //if invalid
        if (!$this->validate($rules)) {
            return redirect()->to('/admin/partners/edit/' . $id)->withInput();
        }

        $imagesFile = $this->request->getFile('images');
        if ($imagesFile->getError() == 4) {
            $imagesName = $this->request->getVar('oldImages');
        } else {
            //random
            $imagesName = $imagesFile->getRandomName();
            //move gambar
            $imagesFile->move('img', $imagesName);
            unlink('img/' . $this->request->getVar('oldImages'));
        }

        //setup data to db
        $data = [
            'id' => $id,
            'images' => $imagesName,
            'link'     => $this->request->getVar('link'),
            'status'    => $this->request->getVar('status'),
            'updateBy' => session()->get('username'),
        ];
        $this->partnersModel->save($data);
        session()->setFlashdata('msg', 'Partner Successfully Updated');
        return redirect()->to('/admin/partners');
    }

    public function destroy($id)
    {
        $partners = $this->partnersModel->find($id);
        unlink('img/' . $partners['images']);
        $this->partnersModel->delete($id);
        session()->setFlashdata('msg', 'Partner Successfully Deleted');
        return redirect()->to('/admin/partners');
    }

}