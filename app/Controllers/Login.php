<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\StudentModel;


use ResourceBundle;

class Login extends ResourceController
{
    use ResponseTrait;
    //get all product
    public function index()
    {
        $stumodel = new StudentModel();
        $logs = [
            "id_stu" =>  $this->request->getVar('id_stu '),
            "password_stu" =>  $this->request->getVar('password_stu')
        ];
        $checks = $stumodel->where($logs)->findAll();
        if (count($checks) == 1) {
            foreach ($checks as $row) {
                $id_stu = $row['id_stu'];
                $fname_stu = $row['fname_stu'];
                $lname_stu = $row['lname_stu'];
            }
            $response = [
                'id_stu' => $id_stu,
                'fname_stu' => $fname_stu,
                'lname_stu' => $lname_stu,
                'message' =>  'Student'
            ];
            return $this->respond($response);
        } else {
            $response = [

                'message' =>  'fail'
            ];
            return $this->respond($response);
        }
    }
}
