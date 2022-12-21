<?php

namespace App\Modules\ServiceFeature\Models;

use CodeIgniter\Model;

class ServiceFeatureModel extends Model
{
    protected $table      = "social_media";
    protected $primaryKey = "id";

    // protected $returnType     = array();
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['icon', 'title', 'description', 'createBy', 'updateBy'];

    protected $useTimestamps = true;
    protected $createdField  = "createDate";
    protected $updatedField  = "updateDate";
    // protected $deletedField  ="deleted_at";

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getService()
    {
        $builder = $this->db->table('service_feature');
        $builder->select('*');
        $builder->join('service_feature_images', 'service_feature_images.service_feature_id = service_feature.id');
        $query = $builder->get();
        return $query;
    }

}