<?php 

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EducationModel;
use ResourceBundle;

class EducationStudent extends ResourceController
{
    use ResponseTrait;

    public function getAllEducation()
    {
        $model = new EducationModel();
        $educationdata['education'] = $model->orderBy('id_edu_stu','DESC')->findAll();
        return $this->respond($educationdata);
    }

    public function getEducation($educationID = null){
        $edumodel = new EducationModel();
        $educationdata = $edumodel->join('student', 'student.id_stu  = edu_stu.id_stu')
        ->join('university', 'university.id_university = edu_stu.id_university')
        ->join('faculty', 'faculty.id_faculty = edu_stu.id_faculty')
        ->join('course', 'course.id_course = edu_stu.id_course')
        ->join('group_major', 'group_major.id_major = edu_stu.id_major')
        ->select('student.*')
        ->select('university.*')
        ->select('faculty.*')
        ->select('course.*')
        ->select('group_major.*')
        ->select('edu_stu.*')
        ->orderBy('edu_stu.id_stu')->first();
        return $this->respond($educationdata);
    }

    public function addEducationStudent(){
        $model = new EducationModel();
        $educationdata =[
            "id_edu_stu"=> $this->request->getvar('id_edu_stu'),
            "id_stu"=> $this->request->getvar('id_stu'),
            "id_university"=> $this->request->getvar('id_university'),
            "id_faculty"=> $this->request->getvar('id_faculty'),
            "id_course"=> $this->request->getvar('id_course'),
            "id_major"=> $this->request->getvar('id_major'),

        ];
        $model->insert($educationdata);
        $response=[
            'satatus'=>201,
            'error'=>null,
            'meessage'=>[
                'success' => 'Add EducationStudent Successfully'
            ]
        ];
            return $this->respond($response);
    } 

    public function updateEducationStudent($educationID = null)
    {
        $model = new EducationModel();
        $educationdata =[
            "id_stu"=> $this->request->getvar('id_stu'),
            "id_university"=> $this->request->getvar('id_university'),
            "id_faculty"=> $this->request->getvar('id_faculty'),
            "id_course"=> $this->request->getvar('id_course'),
            "id_major"=> $this->request->getvar('id_major'),
        ];
        $model->update($educationID, $educationdata);
        $response=[
            'satatus'=>201,
            'error'=>null,
            'meessage'=>[
                'success' => 'Update EducationStudent Successfully'
            ]
        ];
            return $this->respond($response);
    } 

    
}