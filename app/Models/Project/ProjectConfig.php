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


        $where = array('id' => $params['project_id']);

        $this->db->update('tbl_project',$data, $where);
    }

    public function addProject($params) {

        if(empty($data)) {
            $data = date('Y-m-d G:i:s');
        }

        $data_task = array(
            'own_id'       => $params['own_id'],
            'project'      => $params['project'],
            'description'  => $params['description'],
            'created_on'   => $data,
            'updated_on'   => $data,
        );

        $result = $this->db->insert('tbl_project', $data_task);

        return true;
    }

    public function getProject($project_id, $user_id = 0) {

        $sql = "SELECT 
        p.*,
        p.id          as project_id,
        p.project,
        p.description as description,
        p.own_id      as own_id,
        u.id          as user_id,
        u.name        as user_name,
        u.email       as user_email
        FROM tbl_project AS p
        INNER JOIN tbl_user AS u ON p.own_id = u.id
        INNER JOIN tbl_user_rel_project AS r ON p.id = r.project_id
        WHERE p.id = :project_id
        ";

        if($user_id > 0) {
            $sql .= ' AND (p.own_id = :user_id OR r.user_id = :user_id) ';
        }

        $result = $this->db->select($sql, [
            ':project_id' => $project_id,
            ':user_id'    => $user_id,
        ]);

        if(count($result) == 0) {
            return false;
        }

        return $result[0];
    }

    public function getProjects($where = array()) {

        $sql_array = $this->getProjectWhere($where);

        $sql = "SELECT 
        p.id as project_id,
        p.project,
        p.description as description,
        p.own_id as own_id,
        u.name as user_name,
        u.email as user_email {$sql_array['campos']}
        FROM tbl_project AS p
        INNER JOIN tbl_user AS u ON p.own_id = u.id
        {$sql_array['inner']}
        {$sql_array['where']}
        ";

        $result = $this->db->select($sql);

        if(count($result) == 0) {
            return array();
        }

        return $result;
    }

    private function getProjectWhere($where = array()) {

        $campos_sql = '';
        $where_sql  = '';
        $inner_sql  = array();


        if(count($where) > 0) {
            $where_sql .= 'WHERE ';
        }

        if(isset($where['own_id']) && isset($where['user_id'])) {
            $inner_sql[] = 'INNER JOIN tbl_user_rel_project AS r ON p.id = r.project_id';
            $where_sql  .= 'p.own_id = ' . $where['own_id'] .
                           ' OR ' .
                           'r.user_id = ' . $where['user_id'] ;

        } elseif(isset($where['own_id'])) {
            $where_sql .= 'p.own_id = ' . $where['own_id'] ;
        } elseif(isset($where['user_id'])) {

        }

        return array(
            'campos' => $campos_sql,
            'inner'  => implode("\n", $inner_sql),
            'where'  => $where_sql
        );
    }

}