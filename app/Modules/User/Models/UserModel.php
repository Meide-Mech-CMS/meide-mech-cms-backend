<?php

namespace App\Modules\User\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = "user";
    protected $primaryKey = "id";

    // protected $returnType     = array();
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['full_name', 'username', 'email', 'password', 'uuid', 'last_login', 'last_login_ip', 'last_login_agent', 'browser_name', 'is_online', 'status', 'rules', 'images', 'thumbnail_images', 'createBy', 'updateBy'];

    protected $useTimestamps = true;
    protected $createdField  = "createDate";
    protected $updatedField  = "updateDate";
    // protected $deletedField  ="deleted_at";

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

}