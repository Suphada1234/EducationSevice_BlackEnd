<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CourseModel;



class Course extends ResourceController
{
    use ResponseTrait;
    //+createCourse(courseData) : Course
    //+updateCourse(courseName): boolean
    //+editCouse(editAttr,editdata) :boolean
    //+addGroupMajor(groupMajor) : boolean
    //+getGroupMajor() :string
    //+addDegree(degree) : boolean
    //+getDegree():string



    public function index()
    {
        $couse = new CourseModel();

        $datacouse = $couse->join('group_major','group_major.id_major = course.id_major')
        ->join('degree','degree.id_degree = course.id_degree')
        ->select('course.*')
        ->select('group_major.*')
        ->select('degree.*')
        ->orderBy('id_course','DESC')->findAll();        
        return $this->respond($datacouse);

    }

    public function createCourse(){

        $couse = new CourseModel();
        $data =[
            "id_course"=> $this->request->getvar('id_course'),
            "name_course"=> $this->request->getvar('name_course'),
            "id_major"=> $this->request->getvar('id_major'),
            "id_degree"=> $this->request->getvar('id_degree')

        ];
        $checkcourse = $couse->where('name_course',$data['name_course'])->first();
        if ($checkcourse === null){
            $couse->insert($data);
            $response=[
                'satatus'=>201,
                'error'=>null,
                'meessage'=>[
                    'success' => 'เพิ่มสาขาสำเร็จ !!'
                ]
            ];
                return $this->respond($response);
        } else {
            $response = [
                'satatus' => 202,
                'error' => null,
                'meessage' => [
                    'success' => 'สาขานี้ มีข้อมูลอยู่แล้ว !!'
                ]
            ];

            return $this->respond($response);
        }
        
    } 

    public function updateCourse($id = null)
    {
        
        $couse = new CourseModel();
        $data =[
            "name_course"=> $this->request->getvar('name_course'),
            "id_major"=> $this->request->getvar('id_major'),
            "id_degree"=> $this->request->getvar('id_degree')
        ];

        $couse->update($id, $data);
        $response=[
            'satatus'=>201,
            'error'=>null,
            'meessage'=>[
                'success' => 'Course Update successfully'
            ]
        ];
            return $this->respond($response);
    } 
   

    
}
?>