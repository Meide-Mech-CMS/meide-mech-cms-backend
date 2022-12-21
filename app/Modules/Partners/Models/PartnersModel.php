<?php

namespace App\Modules\Partners\Models;

use CodeIgniter\Model;

class PartnersModel extends Model
{
    protected $table      = "partners";
    protected $primaryKey = "id";

    // protected $returnType     = array();
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['images', 'link', 'status', 'createBy', 'updateBy'];

    protected $useTimestamps = true;
    protected $createdField  = "createDate";
    protected $updatedField  = "updateDate";
    // protected $deletedField  ="deleted_at";

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}