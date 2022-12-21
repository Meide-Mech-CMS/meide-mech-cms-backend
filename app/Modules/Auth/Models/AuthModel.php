<?php

namespace App\Modules\Auth\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table      = "user";
    protected $primaryKey = "id";

    protected $allowedFields = ['full_name', 'username', 'email', 'password', 'uuid', 'last_login', 'last_login_ip', 'last_login_agent', 'browser_name', 'is_online', 'status', 'rules', 'images', 'thumbnail_images', 'createBy', 'updateBy'];

    // protected $returnType     = array();
    // protected $useSoftDeletes = true;

    // protected $allowedFields = [];

    protected $useTimestamps = true;
    protected $createdField  = "createDate";
    protected $updatedField  = "updateDate";
    // protected $deletedField  ="deleted_at";

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}