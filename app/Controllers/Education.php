<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EducationModel;
use ResourceBundle;

class Education extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new EducationModel();
        $educationdata['education'] = $model->orderBy('id_education','DESC')->findAll();
        return $this->respond($educationdata);
    }
    public function getEducationById($id = null){
        $model = new EducationModel();
        $educationdata = $model->join('round', 'round.id_round = education.id_round ')
        ->join('university', 'university.id_university = education.id_university')
        ->join('schedule','scedule.id_schedule','education.id_schedule')
        ->select('round.name_round')
        ->select('university.name_uni')
        ->select('schedule.detail_schedule')
        ->select('education.*')
        ->orderBy('education.id_ecation')->first();
        return $this->respond($educationdata);
    }

    public function createEducation(){
 
        $model = new EducationModel();
        $educationdata =[
           "year_edu"=> $this->request->getVar('year_edu'),
           "id_round"=> $this->request->getVar('id_round'),
           "id_university"=> $this->request->getVar('id_university'),
           "tcas"=> $this->request->getVar('tcas'),
           "open_date"=> $this->request->getVar('open_date'),
           "close_date"=> $this->request->getVar('close_date'),
           "list_day"=> $this->request->getVar('list_day'),
           "general"=> $this->request->getVar('general'),
           "doculment_edu"=> $this->request->getVar('doculment_edu'),
           "note_edu"=> $this->request->getVar('note_edu'),
           "file_doculment"=> $this->request->getVar('file_doculment'),
           "url_doculment"=> $this->request->getVar('url_doculment'),
           "id_schedule"=> $this->request->getVar('id_schedule')
        ];
        $model->insert($educationdata);
        $response=[
            'satatus'=>201,
            'error'=>null,
            'meessage'=>[
                'success' => 'create successfully'
            ],
            'data' => $educationdata
        ];
            return $this->respond($response);
    } 

    public function updateEducation($id = null)
    {
       $model = new EducationModel();
       $dataedu = [
        "year_edu" => $this->request->getVar('year_edu'),
        "id_round" => $this->request->getVar('id_round'),
        "id_university" => $this->request->getVar('id_university'),
        "tcas" => $this->request->getVar('tcas'),
        "open_date" => $this->request->getVar('open_date'),
        "close_date" => $this->request->getVar('close_date'),
        "list_day" => $this->request->getVar('list_day'),
        "general" => $this->request->getVar('general'),
        "doculment_edu" => $this->request->getVar('doculment_edu'),
        "note_edu" => $this->request->getVar('note_edu'),
        "url_doculment" => $this->request->getVar('url_doculment'),
        "id_schedule" => $this->request->getVar('id_schedule')
       ];

       $model->update($id,$dataedu);
       $response = [
        'satatus' => 201,
        'error' => null,
        'meessage' => [
            'success' => 'อัปเดตข้อมูลการศึกษาต่อสำเร็จ !!'
        ]
    ];
    return $this->respond($response);

    } 
  
    public function deletedEducation($id = null){
        $model = new EducationModel();
        $educationdata = $model->delete($id);
        if($educationdata){
            $model->delete($id);
            $response = [
                'satatus' => 200,
                'error' => null,
                'meessage' => [
                    'success' => 'Education delete successfully'
                ]
            ];
            return $this->respond($response);
        }else{
            return $this->failNotFound('No');
        }
    } 
}