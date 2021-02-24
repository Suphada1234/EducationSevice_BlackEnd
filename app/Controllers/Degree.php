<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DegreeModel;

class Degree extends ResourceController
{
    use ResponseTrait;

//+createDegree(degree_id, degree_name) : Degree
//+updateDegree(updateAttr,updatedata) : boolean


    public function index()
    {
        $model = new DegreeModel();
        $data['degree'] = $model->orderBy('id_degree','DESC')->findAll();
        return $this->respond($data);
    }

    public function createDegree(){

//-degree_id : int
//-degree_name :string
//-degree_initials : string


        $model = new DegreeModel();
        $data =[
            "id_degree"=> $this->request->getvar('id_degree'),
            "name_degree"=> $this->request->getvar('name_degree'),
            "initials_degree"=> $this->request->getvar('initials_degree')
        ];
        $model->insert($data);
        $response=[
            'satatus'=>201,
            'error'=>null,
            'meessage'=>[
                'success' => 'Degree create successfully'
            ]
        ];
            return $this->respond($response);
    } 

    public function updateDegree($id = null)
    {
        
        $model = new DegreeModel();
        $data =[
            "name_degree"=> $this->request->getvar('name_degree'),
            "initials_degree"=> $this->request->getvar('initials_degree')
        ];

        $model->update($id, $data);
        $response=[
            'satatus'=>201,
            'error'=>null,
            'meessage'=>[
                'success' => 'Degree create successfully'
            ]
        ];
            return $this->respond($response);
    } 
   

    
}
?>