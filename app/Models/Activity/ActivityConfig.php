<?php 

namespace App\Models\Project;

use Core\Model;

class ProjectConfig extends Model 
{    

    function __construct() {
        parent::__construct();
    }  

    public function addActivity($params) {

        $sql = "SELECT 
        p.id as project_id,
        p.project,
        p.description as description,
        p.own_id as own_id,
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
