<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\StudentModel;
use App\Models\StaffModel;


use ResourceBundle;

class Login extends ResourceController
{
    use ResponseTrait;
    //login ไม่ใช้ StaffModel
    public function index()
    {
        $student = new StudentModel();
        

        $logstu = [
            "id_stu" =>  $this->request->getVar('id'),
            "password_stu" =>  $this->request->getVar('password')
            //"password_stu" =>  md5($this->request->getVar('password'))
        ];

        $logsatff = [
            "id_staff" => $this->request->getVAr('id'),
            "password_staff" => $this->request->getVar('password')
            //"password_staff" => md5($this->request->getVar('password'))
        ];

        $db = \Config\Database::connect(); //เชื่อมฐานข้อมูล

        $staff = $db->table('staff');
        $staff->join('title','title.id_title = staff.id_title');
        $staff->join('position','position.id_position = staff.id_position');
        $staff->where($logsatff); // ที่ id กับ password
        $querystaff = $staff->get();

        $checkstu = $student->where($logstu)->findAll();
        $checkstaff = $querystaff->getResult();
        //$checkstaff = $staff->where($logsatff)->findAll();
    

        if (count($logstu) == 1) {
           foreach ($checkstu as $row) {
                $id = $row['id_stu'];
                
                $fname = $row['fname_stu'];
                $lname = $row['lname_stu'];
            }
            $response = [
                'id' => $id,     
                'fname' => $fname,
                'lname' => $lname,
                'Status' => 'Student'
            ];

            return $this->respond($response);
        } elseif (count($checkstaff) == 1) {
            foreach ($checkstaff as $row) {
                $id = $row->id_staff;
                $title = $row->name_title;
                $fname = $row->fname_staff;
                $lname = $row->lname_staff;
                $position = $row->name_position;
            }
            $response = [
                'id' => $id,
                'title' => $title,
                'fname' => $fname,
                'lname' => $lname,
                'Status' => $position
            ];
            return $this->respond($response);
        } else {
            $response = [
                'message' => 'id or password Fail !!'
            ];

            return $this->respond($response);
        }
    }

    //login โดยใช้StaffModel
    public function login2()
    {
        $student = new StudentModel();
        $staff = new StaffModel();

        $logstu = [
            "id_stu" =>  $this->request->getVar('id'),
            "password_stu" =>  $this->request->getVar('password')
            //"password_stu" =>  md5($this->request->getVar('password'))
        ];

        $logsatff = [
            "id_staff" => $this->request->getVAr('id'),
            "password_staff" => $this->request->getVar('password')
            //"password_staff" => md5($this->request->getVar('password'))
        ];
        


        $datastaff = $staff->join('title', 'title.id_title = staff.id_title');
        $staff->join('position', 'position.id_position = staff.id_position');
        $staff->select('title.name_title');
        $staff->select('position.name_position');
        $staff->select('staff.*');
        $staff->where($logsatff);
        $querystaff = $datastaff->get();
    


        $checkstu = $student->where($logstu)->findAll();
        $checkstaff = $querystaff->getResult();
        //$checkstaff = $staff->where($logsatff)->findAll();


        if (count($checkstu) == 1) {
            foreach ($checkstu as $row) {
                $id = $row['id_stu'];
                $fname = $row['fname_stu'];
                $lname = $row['lname_stu'];
            }
            $response = [
                'id' => $id,
                'fname' => $fname,
                'lname' => $lname,
                'Status' => 'Student'
            ];

            return $this->respond($response);
        } elseif (count($checkstaff) == 1) {
            foreach ($checkstaff as $row) {
                $id = $row->id_staff;
                $title = $row->name_title;
                $fname = $row->fname_staff;
                $lname = $row->lname_staff;
                $position = $row->name_position;
            }
            $response = [
                'id' => $id,
                'title' => $title,
                'fname' => $fname,
                'lname' => $lname,
                'Status' => $position
            ];
            return $this->respond($response);
        } else {
            $response = [
                'message' => 'id or password Fail !!'
            ];

            return $this->respond($response);
        }
    }
}
