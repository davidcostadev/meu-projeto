<?php 

namespace App\Models\Group;

use Core\Model;

class GroupConfig extends Model 
{    

    function __construct() {
        parent::__construct();
    }  

    public function updateGroup($params) {

        // $data = array();

        // if(isset($params['own_id']) && !empty($params['own_id'])) {
        //     $data['own_id']      = $params['own_id'];
        // }
        // if(isset($params['project']) && !empty($params['project'])) {
        //     $data['project']     = $params['project'];
        // }
        // if(isset($params['description']) && !empty($params['description'])) {
        //     $data['description'] = $params['description'];
        // }


        // $data['updated_on']  = date('Y-m-d G:i:s');


        // $where = array('project_id' => $params['project_id']);

        // $this->db->update('tbl_project',$data, $where);
    }

    public function addGroup($params) {

        
        if($this->getGroup($param['project_id'], $param['user_id']) != false) {
            return 1;
        }


        if(empty($data)) {
            $data = date('Y-m-d G:i:s');
        }

        $data_task = array(
            'project_id'  => $params['project_id'],
            'user_id'     => $params['user_id'],
            'permission'  => $params['permission'],
            'created_on'  => $data,
            'updated_on'  => $data
        );

        $result = $this->db->insert('tbl_user_rel_project', $data_task);

        return 2;
    }

    public function getGroup($project_id, $user_id = 0) {

        $sql = "SELECT 
        r.*
        FROM tbl_user_rel_project AS r
        WHERE r.project_id = :project_id and r.user_id = :user_id
        ";


        $result = $this->db->select($sql, [
            ':project_id' => $project_id,
            ':user_id'    => $user_id,
        ]);

        if(count($result) == 0) {
            return false;
        }

        return $result[0];
    }

    public function getGroups($where = array()) {

        $sql_array = $this->getGroupWhere($where);

        $sql = "SELECT 
        r.* {$sql_array['campos']}
        FROM tbl_user_rel_project AS r
        {$sql_array['inner']}
        {$sql_array['where']}
        ";

        $result = $this->db->select($sql);

        if(count($result) == 0) {
            return array();
        }

        return $result;
    }

    private function getGroupWhere($where = array()) {

        $campos_sql = '';
        $where_sql = '';
        $inner_sql = array();

        if(count($where) > 0) {
            $where_sql .= 'WHERE ';
        }

        if(isset($where['project_id']) && isset($where['user_id'])) {
            $campos_sql .= ', u.*';
            $inner_sql[] = 'INNER JOIN tbl_user AS u ON r.user_id = u.id';
            $where_sql  .= 'r.project_id = ' . $where['project_id'] .
                          ' AND ' .
                          'r.user_id = ' . $where['user_id'] ;

        } elseif(isset($where['project_id']) && isset($where['not_own_id'])) {
            $campos_sql .= ', u.*';
            $inner_sql[] = 'INNER JOIN tbl_project AS p ON r.project_id = p.id';
            $inner_sql[] = 'INNER JOIN tbl_user AS u ON r.user_id = u.id';
            $where_sql  .= 'p.own_id != r.user_id AND r.project_id = ' . $where['project_id'];
        } elseif(isset($where['project_id'])) {
            $campos_sql .= ', u.*';
            $inner_sql[] = 'INNER JOIN tbl_user AS u ON r.user_id = u.id';
            $where_sql  .= 'r.project_id = ' . $where['project_id'] ;
        }


        return array(
            'campos' => $campos_sql,
            'inner'  => implode("\n", $inner_sql),
            'where'  => $where_sql
        );
    }

}