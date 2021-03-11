<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EduDetailModel;
use ResourceBundle;

class EduDetail extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new EduDetailModel();
        $educationDetaildata['eduDetail'] = $model->orderBy('id_edu_Detail', 'DESC')->findAll();
        return $this->respond($educationDetaildata);
    }

    public function getEduDetail()
    {
        $model = new EduDetailModel();
        $educationDetaildata = $model->join('course', 'course.id_course = education_detail.id_course ')
        ->join('faculty', 'faculty.id_faculty = education_detail.id_faculty')
        ->join('edu_condition', 'edu_condition.id_condition = education_detail.id_condition')
        ->select('course.name_course')
        ->select('faculty.name_faculty')
        ->select('edu_condition.GPA'.'edu_condition.curriculum_edu','edu_condition.note_condi')
        ->select('education_detail.*')
        ->orderBy('education_detail.id_edu_detail')->first();
        return $this->respond($educationDetaildata);
    }

    public function createEduDetail()
    {

        $model = new EduDetailModel();
        $educationDetaildata = [
            "number_of_edu" => $this->request->getVar('number_of_edu'),
            "id_course" => $this->request->getVar('id_round'),
            "id_faculty" => $this->request->getVar('id_university'),
            "id_condition" => $this->request->getVar('id_condition'),
            "id_education" => $this->request->getVar('id_education')
        ];
        $model->insert($educationDetaildata);
        $response = [
            'satatus' => 201,
            'error' => null,
            'meessage' => [
                'success' => 'EducationDetail create successfully'
            ]
        ];
        return $this->respond($response);
    }

    public function updateEduDetail($id = null)
    {
        $model = new EduDetailModel();
        $educationDetaildata = [
            "number_of_edu" => $this->request->getVar('number_of_edu'),
            "id_course" => $this->request->getVar('id_round'),
            "id_faculty" => $this->request->getVar('id_university'),
            "id_condition" => $this->request->getVar('id_condition'),
            "id_education" => $this->request->getVar('id_education')
        ];

        $model->update($id, $educationDetaildata);
        $response = [
            'satatus' => 201,
            'error' => null,
            'message' => [
                'success' => 'EducationDetail create successfully'
            ]
        ];
        return $this->respond($response);
    }
}
