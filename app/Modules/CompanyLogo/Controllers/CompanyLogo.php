<?php

namespace App\Modules\CompanyLogo\Controllers;

use App\Modules\CompanyLogo\Models\CompanyLogoModel;

class CompanyLogo extends BaseController
{
    public $comLogModel;
    public function __construct()
    {
        $this->comLogModel = new CompanyLogoModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Company Logo Manager',
            'view' => 'admin/company_logo/index',
            'data' => $this->comLogModel->findAll(),
        ];

        return view('template/dashboard', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Company Logo',
            'view' => 'admin/company_logo/create',
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
            return redirect()->to('/admin/company_logo/add')->withInput();
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
            'thumbnail_images'  => $imagesName,
            'createBy' => session()->get('username'),
            'updateBy' => session()->get('username'),
        ];
        $this->comLogModel->save($data);
        session()->setFlashdata('msg', 'Company Logo Successfully Created');
        return redirect()->to('/admin/company_logo');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Company Logo',
            'view' => 'admin/company_logo/edit',
            'data' => $this->comLogModel->find($id),
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
            return redirect()->to('/admin/company_logo/edit/' . $id)->withInput();
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
            'thumbnail_images'  => $imagesName,
            'status'    => $this->request->getVar('status'),
            'updateBy' => session()->get('username'),
        ];
        $this->comLogModel->save($data);
        session()->setFlashdata('msg', 'Company Logo Successfully Updated');
        return redirect()->to('/admin/company_logo');
    }

    public function destroy($id)
    {
        $comLog = $this->comLogModel->find($id);
        unlink('img/' . $comLog['images']);
        $this->comLogModel->delete($id);
        session()->setFlashdata('msg', 'Company Logo Successfully Deleted');
        return redirect()->to('/admin/company_logo');
    }

    public function getCompanyLogo()
    {
        $data = $this->comLogModel->where(['status' => '1'])->findAll();

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