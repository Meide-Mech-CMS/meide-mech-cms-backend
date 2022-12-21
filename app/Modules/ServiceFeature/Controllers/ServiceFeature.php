<?php

namespace App\Modules\ServiceFeature\Controllers;

use App\Modules\ServiceFeature\Models\ServiceFeatureModel;

class ServiceFeature extends BaseController
{
    public $service_featModel;
    public function __construct()
    {
        $this->service_featModel = new ServiceFeatureModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Service Feature Manager',
            'view' => 'admin/service_feature/index',
            'data' => $this->service_featModel->findAll(),
        ];

        return view('template/dashboard', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Service Feature',
            'view' => 'admin/service_feature/create',
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function store()
    {
        helper(['form']);

        //validation
        $rules = [
            'icon'         => 'uploaded[icon]|mime_in[icon,image/svg,image/svg+xml]',
            'title'          => 'required',
            'description'    => 'required',
        ];

        //if invalid
        if (!$this->validate($rules)) {
            // dd(\Config\Services::validation());
            // dd($this->request->getFiles());
            return redirect()->to('/admin/service_feature/add')->withInput();
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
            'title'     => $this->request->getVar('title'),
            'description'    => $this->request->getVar('description'),
            'createBy' => session()->get('username'),
            'updateBy' => session()->get('username'),
        ];
        $this->service_featModel->save($data);
        session()->setFlashdata('msg', 'Service Feature Successfully Created');
        return redirect()->to('/admin/service_feature');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Service Feature',
            'view' => 'admin/service_feature/edit',
            'data' => $this->service_featModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function update($id)
    {
        helper(['form']);

        //validation
        $rules = [
            'icon'         => 'mime_in[icon,image/svg,image/svg+xml]',
            'title'          => 'required',
            'description'    => 'required',
        ];

        //if invalid
        if (!$this->validate($rules)) {
            return redirect()->to('/admin/service_feature/edit/' . $id)->withInput();
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
            'title'     => $this->request->getVar('title'),
            'description'    => $this->request->getVar('description'),
            'updateBy' => session()->get('username'),
        ];
        $this->service_featModel->save($data);
        session()->setFlashdata('msg', 'Service Feature Successfully Updated');
        return redirect()->to('/admin/service_feature');
    }

    public function destroy($id)
    {
        $service_feat = $this->service_featModel->find($id);
        unlink('img/' . $service_feat['icon']);
        $this->service_featModel->delete($id);
        session()->setFlashdata('msg', 'Service Feature Successfully Deleted');
        return redirect()->to('/admin/service_feature');
    }

    public function getServiceFeature()
    {
        // $data = $this->service_featModel->where(['status' => '1'])->findAll();
        $response = $this->service_featModel->getService()->getResult();

        // $response = [];
        // foreach ($data as $d) {
        //     $service_img = [];
        //     foreach ($service as $img) {
        //         array_push($service_img, $img);
        //     }
        //     $setup = [
        //         'icon' => $d['icon'],
        //         'title' => $d['title'],
        //         'description' => $d['description'],
        //         'service_feature_image' => $service_img
        //     ];
        //     array_push($response, $setup);
        // }
        return $this->response->setJSON($response);
    }
}