<?php

namespace App\Modules\CompanyLogo\Models;

use CodeIgniter\Model;

class CompanyLogoModel extends Model
{
    protected $table      = "company_logo";
    protected $primaryKey = "id";

    // protected $returnType     = array();
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['images', 'thumbnail_images', 'createBy', 'updateBy'];

    protected $useTimestamps = true;
    protected $createdField  = "createDate";
    protected $updatedField  = "updateDate";
    // protected $deletedField  ="deleted_at";

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}