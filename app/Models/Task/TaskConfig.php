<?php 

namespace App\Models\Task;

use Core\Model;

class TaskConfig extends Model 
{    

    function __construct() {
        parent::__construct();
    }  

    public function updateTask($params) {

        $data = array();

        if(isset($params['task']) && !empty($params['task'])) {
            $data['task']        = $params['task'];
        }
        if(isset($params['description']) && !empty($params['description'])) {
            $data['description'] = $params['description'];
        }
        if(isset($params['status']) && !empty($params['status'])) {
            $data['status']      = $params['status'];
        }
        if(isset($params['priority']) && !empty($params['priority'])) {
            $data['priority']    = $params['priority'];
        }
        if(isset($params['kind']) && !empty($params['kind'])) {
            $data['kind']        = $params['kind'];
        }

        $data['updated_on']  = date('Y-m-d G:i:s');



        $where = array('id' => $params['task_id']);

        $this->db->update('tbl_task',$data, $where);
    }

    public function addTask($params) {

        if(empty($data)) {
            $data = date('Y-m-d G:i:s');
        }


        $data_task = array(
            'own_id'      => USUARIO_ID,
            'project_id'  => $params['project_id'],
            'task'        => $params['task'],
            'description' => $params['description'],
            'status'      => $params['status'],
            'priority'    => $params['priority'],
            'kind'        => $params['kind'],
            'created_on'   => $data,
            'updated_on'   => $data,
        );

        $result = $this->db->insert('tbl_task', $data_task);

        return true;
    }

    public function getTask($task_id) {

        $sql = "SELECT 
        t.*,
        t.id    as task_id,
        u.id    as user_id,
        u.name  as user_name,
        u.name  as user_email,
        p.id    as project_id,
        p.project,
        c.id    as client_id,
        c.name  as client_name,
        c.email as client_email

        FROM tbl_task AS t
        INNER JOIN tbl_user AS u ON t.own_id = u.id
        INNER JOIN tbl_project AS p ON t.project_id = p.id
        INNER JOIN tbl_user AS c ON p.own_id = c.id
        
        WHERE t.id = :task_id

        ";

        $result = $this->db->select($sql, [
            ':task_id'    => $task_id
        ]);

        if(count($result) == 0) {
            return false;
        }

        return $result[0];
    }

    public function getTasks($params = array()) {

        $sql = "SELECT 
        t.*,
        u.name as user_name
        FROM tbl_task AS t
        INNER JOIN tbl_user AS u ON t.own_id = u.id
        WHERE t.project_id = :project_id
        
        AND t.status != 'resolved'
        AND t.status != 'closed'


        ORDER BY t.priority ASC, t.status ASC, t.updated_on ASC
        LIMIT 5
        ";

        $result = $this->db->select($sql, array(':project_id' => $params['project_id']));

        if(count($result) == 0) {
            return array();
        }

        return $result;
    }

    public function getQuantTasksQuery($params, $status = array(), $priority = array(), $kind = array()) {

        $sql = "SELECT count(*) as quant
        FROM tbl_task AS t";

        if(count($params) > 0) {
            $sql .= "\n  WHERE 
            t.project_id = :project_id \n";
        }

        if(count($params) == 0 && (!empty($status) || !empty($priority)|| !empty($kind))) {
            $sql .= "\n WHERE 1 = 1 ";
        }
        
        // status ----

        if(is_string($status)) {
            $status = array($status);
        }

        $statusList = [
            'new',
            'open',
            'onhold',
            'resolved',
            'invalid',
            'wontfix',
            'closed'
        ];

        if(count($status)) $sql .= ' AND (';

        $sql .= $this->setWhereVar($status, 't.status', $statusList);

        if(count($status)) $sql .= ') ';


        // priority ----

        if(is_string($priority)) $priority = array($priority);
        
        $priorityList = [
            'high',
            'average',
            'low'
        ];

        if(count($priority)) $sql .= ' AND (';

        $sql .= $this->setWhereVar($priority, 't.t.priority', $priorityList);

        if(count($priority)) $sql .= ') ';



        // kind ----

        if(is_string($kind)) $kind = array($kind);

        $kindList = [
            'bug',
            'implementation',
            'change',
            'task',
            'proposal'
        ];

        if(count($kind)) $sql .= ' AND (';

        $sql .= $this->setWhereVar($kind, 't.kind', $kindList);

        if(count($kind)) $sql .= ') ';


        $result = $this->db->select($sql, array(':project_id' => $params['project_id']));

        if(count($result) == 0) {
            return array();
        }

        return $result;
    }

    public static function getQuantTasks($params, $status = array(), $priority = array(), $kind = array()) {
        $self = new self();
        $return = $self->getQuantTasksQuery($params, $status, $priority, $kind);

        if(count($return) == 0) {
            return 0;
        } else {
            return $return[0]->quant;
        }
    }

    public static function getIconPriority($priority) {
        switch ($priority) {
            case 'high' :
                $return = 'fa fa-chevron-up textcolor-red';
                break;
            case 'low' :
                $return = 'fa fa-chevron-down textcolor-gray';
                break;
            default:
            case 'average' :
                $return = 'fa fa-circle textcolor-blue';
                break;
        }

        return $return;
    }

    public static function getIconKind($kind) {
        switch ($kind) {
            case 'bug' :
                $return = 'fa fa-bug';
                break;
            case 'implementation' :
                $return = 'fa fa-plus-circle';
                break;
            case 'change' :
                $return = 'fa fa-refresh';
                break;
            case 'proposal' :
                $return = 'fa fa-bookmark';
                break;
            case 'task' :
            default: 
                $return = 'fa fa-edit';
                break;
        }

        return $return;
    }

    private function verificarWhereVar($vars, $field, $var_list, $glue = 'OR') {

        $sql = '';

        foreach ($vars as $key => $var) {
            if(is_string($key)) {
                if(strtolower($key) == 'and') {
                    $sql .= $this->setWhereVar($var, $field, $var_list, $key);
                } else {
                    $sql .= $this->setWhereVar($var, $field, $var_list);
                }
            } else {
                $sql .= $this->setWhereVar($var, $field, $var_list);
            }
        }

        return $sql;
    }

    private function setWhereVar($vars, $field, $var_list, $glue = 'OR') {

        $sql_array = array();

        foreach ($vars as $key => $var) {
            if(is_string($key)) {
                $sql_array[] = $this->verificarWhereVar($vars, $field, $var_list, $key);
            }
            for ($i=0; $i < count($var_list); $i++) { 
                if($var_list[$i] == $var || '!'.$var_list[$i] == $var) {
                    if('!'.$var_list[$i] == $var) {
                        $var = str_replace('!', '', $var);
                        $sql_array[] = "$field != '$var' ";
                    } else {
                        $sql_array[] = "$field = '$var' ";   
                    }
                }
            }
            if($var) {

            }
        }

        return implode(' '.$glue.' ', $sql_array);
    }
}