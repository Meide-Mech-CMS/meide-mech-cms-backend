<?php

namespace App\Modules\Certificate\Controllers;

use App\Modules\Certificate\Models\CertificateModel;

class Certificate extends BaseController
{
    public $certificateModel;
    public function __construct()
    {
        $this->certificateModel = new CertificateModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Certificate Manager',
            'view' => 'admin/certificate/index',
            'data' => $this->certificateModel->findAll(),
        ];

        return view('template/dashboard', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Certificate',
            'view' => 'admin/certificate/create',
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function store()
    {
        helper(['form']);

        //validation
        $rules = [
            'images'         => 'uploaded[images]|is_image[images]|mime_in[images,image/jpg,image/png,image/jpeg]',
        ];

        //if invalid
        if (!$this->validate($rules)) {
            // dd(\Config\Services::validation());
            // dd($this->request->getFiles());
            return redirect()->to('/admin/certificate/add')->withInput();
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
            'images_thumbnail' => $imagesName,
            'status'    => $this->request->getVar('status'),
            'createBy' => session()->get('username'),
            'updateBy' => session()->get('username'),
        ];
        $this->certificateModel->save($data);
        session()->setFlashdata('msg', 'Certificate Successfully Created');
        return redirect()->to('/admin/certificate');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Certificate',
            'view' => 'admin/certificate/edit',
            'data' => $this->certificateModel->find($id),
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
        ];

        //if invalid
        if (!$this->validate($rules)) {
            return redirect()->to('/admin/certificate/edit/' . $id)->withInput();
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
            'images_thumbnail' => $imagesName,
            'status'    => $this->request->getVar('status'),
            'updateBy' => session()->get('username'),
        ];
        $this->certificateModel->save($data);
        session()->setFlashdata('msg', 'Certificate Successfully Updated');
        return redirect()->to('/admin/certificate');
    }

    public function destroy($id)
    {
        $certificate = $this->certificateModel->find($id);
        unlink('img/' . $certificate['images']);
        $this->certificateModel->delete($id);
        session()->setFlashdata('msg', 'Certificate Successfully Deleted');
        return redirect()->to('/admin/certificate');
    }

    public function getCertificate()
    {
        $data = $this->certificateModel->where(['status' => '1'])->findAll();

        $response = [];
        foreach ($data as $d) {
            $images = base_url() . '/img/' . $d['images'];
            $setup = [
                'images' => $images,
            ];
            array_push($response, $setup);
        }
        return $this->response->setJSON($response);
    }
}