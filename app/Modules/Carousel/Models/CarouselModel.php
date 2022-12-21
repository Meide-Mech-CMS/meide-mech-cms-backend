<?php

namespace App\Modules\Carousel\Models;

use CodeIgniter\Model;

class CarouselModel extends Model
{
    protected $table      = "carousel";
    protected $primaryKey = "id";

    // protected $returnType     = array();
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['images', 'thumbnail_images', 'title', 'description', 'link', 'status', 'createBy', 'updateBy'];

    protected $useTimestamps = true;
    protected $createdField  = "createDate";
    protected $updatedField  = "updateDate";
    // protected $deletedField  ="deleted_at";

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}