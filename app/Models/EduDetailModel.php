<?php

namespace App\Models;

use CodeIgniter\Model;

class EduDetailModel extends Model
{
    protected $table = 'education_detail';
    protected $primarykey = 'id_edu_detail';
    protected $allowedFields = ['number_of_edu','id_course','id_faculty','id_condition','id_education'];
    
  
}
