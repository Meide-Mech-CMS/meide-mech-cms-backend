<?php

namespace App\Modules\Category\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = "category";
    protected $primaryKey = "id";

    // protected $returnType     = array();
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'there_is_sub_category', 'status', 'createBy', 'updateBy'];

    protected $useTimestamps = true;
    protected $createdField  = "createDate";
    protected $updatedField  = "updateDate";
    // protected $deletedField  ="deleted_at";

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getCategory()
    {
        $builder = $this->db->table('category');
        $builder->select('*, category.name as category');
        $builder->join('sub_category', 'sub_category.parent_category_id = category.id');
        $query = $builder->get();
        return $query;
    }
}