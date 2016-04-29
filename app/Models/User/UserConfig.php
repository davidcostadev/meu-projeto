<?php 

namespace App\Models\User;

use Core\Model;
use Helpers\Session;
use Helpers\Password;

class UserConfig extends Model 
{   

    function __construct() {
        parent::__construct();
    }  

    public function getUsers($where = array()) {

        $sql_array = $this->getUsersWhere($where);

        $sql = "SELECT 
        u.*,
        u.id AS user_id {$sql_array['campos']}
        FROM tbl_user AS u
        {$sql_array['inner']}
        {$sql_array['where']}
        ";

        //die($sql);
        $result = $this->db->select($sql);

        if(count($result) == 0) {
            return array();
        }

        return $result;
    }

    public function logar($params) {
        
        if(empty($params['email'])) {
            return -1;
        } elseif(empty($params['password'])) {
            return -2;
        }

        $sql = "SELECT * FROM tbl_user WHERE `email`=:email";
        $result = $this->db->select($sql, array(':email' => $params['email']));

        if(count($result) == 0) {
            return -3;
        }

        if(Password::verify($params['password'], $result[0]->password)) {

            Session::set('user_id', $result[0]->id);
            
            return true;
        } else {
            return -4;
        }

        return $this->db->select('SELECT 
            email, password
            FROM tbl_users'
        );
    }

    private function getUsersWhere($where = array()) {

        $campos_sql = '';
        $where_sql  = '';
        $inner_sql  = array();


        if(count($where) > 0) {
            $where_sql .= 'WHERE ';
        }

        if(isset($where['project_id']) && isset($where['user_id'])) {
         
        } elseif(isset($where['project_id']) && isset($where['not_own_id'])) {
            //$campos_sql .= ', u.*';
            $inner_sql[] = 'INNER JOIN tbl_project AS p ON p.own_id = u.id';
            $where_sql  .= 'p.id != ' . $where['project_id'];
            $where_sql  .= "\n".'GROUP BY u.id';
        } elseif(isset($where['project_id'])) {
            
        }

        return array(
            'campos' => $campos_sql,
            'inner'  => implode("\n", $inner_sql),
            'where'  => $where_sql
        );
    }
}