<?php

namespace App\Modules\Category\Controllers;

use App\Modules\Category\Models\CategoryModel;

class Category extends BaseController
{
    public $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new CategoryModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Carousel Manager',
            'view' => 'admin/carousel/index',
            'data' => $this->categoryModel->findAll(),
        ];

        return view('template/dashboard', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Carousel',
            'view' => 'admin/carousel/create',
            'validation' => \Config\Services::validation()
        ];

        return view('template/dashboard', $data);
    }

    public function store()
    {
        helper(['form']);

        //validation
        $rules = [
            'images'            => 'uploaded[images]|mime_in[images,image/jpg,image/png,image/jpeg]',
            'title'             => 'required|min_length[4]|max_length[15]',
            'description'       => 'required|min_length[4]|max_length[70]',
            'link'              => 'required',
        ];

        //if invalid
        if (!$this->validate($rules)) {
            // dd(\Config\Services::validation());
            // dd($this->request->getFiles());
            return redirect()->to('/admin/carousel/add')->withInput();
        }

        //save images
        $imagesFile = $this->request->getFile('images');
        //random
        $imagesName = $imagesFile->getRandomName();
        //move gambar
        $imagesFile->move('img', $imagesName);

        //setup data to db
        $data = [
            'images'            => $imagesName,
            'thumbnail_images'  => $imagesName,
            'title'             => $this->request->getVar('title'),
            'description'       => $this->request->getVar('description'),
            'link'              => $this->request->getVar('link'),
            'status'            => $this->request->getVar('status'),
            'createBy'          => session()->get('username'),
            'updateBy'          => session()->get('username'),
        ];
        $this->categoryModel->save($data);
        session()->setFlashdata('msg', 'Carousel Successfully Created');
        return redirect()->to('/admin/carousel');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Carousel',
            'view' => 'admin/carousel/edit',
            'data' => $this->categoryModel->find($id),
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
            return redirect()->to('/admin/carousel/edit/' . $id)->withInput();
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
            'title'             => $this->request->getVar('title'),
            'description'       => $this->request->getVar('description'),
            'link'     => $this->request->getVar('link'),
            'status'    => $this->request->getVar('status'),
            'updateBy' => session()->get('username'),
        ];
        $this->categoryModel->save($data);
        session()->setFlashdata('msg', 'Carousel Successfully Updated');
        return redirect()->to('/admin/carousel');
    }

    public function destroy($id)
    {
        $Carousel = $this->categoryModel->find($id);
        unlink('img/' . $Carousel['images']);
        $this->categoryModel->delete($id);
        session()->setFlashdata('msg', 'Carousel Successfully Deleted');
        return redirect()->to('/admin/carousel');
    }

    public function getCategory()
    {
        $data = $this->categoryModel->getCategory()->getResult();
        return $this->response->setJSON($data);
    }
}