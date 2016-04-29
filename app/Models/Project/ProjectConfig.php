<?php 

namespace App\Models\Project;

use Core\Model;

class ProjectConfig extends Model 
{    

    function __construct() {
        parent::__construct();
    }  

    public function updateProject($params) {

        $data = array();

        if(isset($params['own_id']) && !empty($params['own_id'])) {
            $data['own_id']      = $params['own_id'];
        }
        if(isset($params['project']) && !empty($params['project'])) {
            $data['project']     = $params['project'];
        }
        if(isset($params['description']) && !empty($params['description'])) {
            $data['description'] = $params['description'];
        }


        $data['updated_on']  = date('Y-m-d G:i:s');


        $where = array('project_id' => $params['project_id']);

        $this->db->update('tbl_project',$data, $where);
    }

    public function addProject($params) {

        if(empty($data)) {
            $data = date('Y-m-d G:i:s');
        }

        $data_task = array(
            'own_id'      => $params['own_id'],
            'project'     => $params['project'],
            'description' => $params['description'],
            'created_on'   => $data,
            'updated_on'   => $data,
        );

        $result = $this->db->insert('tbl_project', $data_task);

        return true;
    }

    public function getProjects() {

        $sql = "SELECT 
        p.id as project_id,
        p.project,
        p.description as project_description,
        p.own_id as project_own_id,
        u.name as user_name,
        u.email as user_email
        FROM tbl_project AS p
        INNER JOIN tbl_user AS u ON p.own_id = u.id
        ";


        $result = $this->db->select($sql);
        //$result = $this->db->select($sql, array(':email' => $params['email']));

        if(count($result) == 0) {
            return array();
        }

        return $result;

    }

}