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


        ORDER BY t.priority ASC, t.updated_on ASC
        LIMIT 5
        ";

        $result = $this->db->select($sql, array(':project_id' => $params['project_id']));
        //$result = $this->db->select($sql, array(':email' => $params['email']));

        if(count($result) == 0) {
            return array();
        }



        return $result;
    }

    public function getQuantTasksQuery($params, $status = array(), $priority = array(), $kind = array()) {

        $sql = "SELECT count(*) as quant
        FROM tbl_task AS t";

        if(count($params) > 0) {
            $sql .= "  WHERE 
            t.project_id = :project_id ";
        }

        if(count($params) == 0 && (!empty($status) || !empty($priority)|| !empty($kind))) {
            $sql .= ' WHERE 1=1 ';
        }
        

        if(is_string($status)) {
            $status = array($status);
        }

        $sql_array = array();
        foreach ($status as $status_str) {
            switch ($status_str) {
                case 'new' :
                    $sql_array[] = 't.status = \'new\' ';
                    break;
                case '!new' :
                    $sql_array[] = 't.status != \'new\' ';
                    break;
                case 'open' :
                    $sql_array[] = 't.status = \'open\' ';
                    break;
                case '!open' :
                    $sql_array[] = 't.status != \'open\' ';
                    break;
                case 'onhold' :
                    $sql_array[] = 't.status = \'onhold\' ';
                    break;
                case '!onhold' :
                    $sql_array[] = 't.status != \'onhold\' ';
                    break;
                case 'resolved' :
                    $sql_array[] = 't.status = \'resolved\' ';
                    break;
                case '!resolved' :
                    $sql_array[] = 't.status != \'resolved\' ';
                    break;
                case 'invalid' :
                    $sql_array[] = 't.status = \'invalid\' ';
                    break;
                case '!invalid' :
                    $sql_array[] = 't.status != \'invalid\' ';
                    break;
                case 'wontfix' :
                    $sql_array[] = 't.status = \'wontfix\' ';
                    break;
                case '!wontfix' :
                    $sql_array[] = 't.status != \'wontfix\' ';
                    break;
                case 'closed' :
                    $sql_array[] = 't.status = \'closed\' ';
                    break;
                case '!closed' :
                    $sql_array[] = 't.status != \'closed\' ';
                    break;
                default:
                    break;
            }
        }

        if(count($status)) {
            $sql .= ' AND (';
        }

        $sql .= implode(' OR ', $sql_array);

        if(count($status)) {
            $sql .= ') ';
        }



        if(is_string($priority)) {
            $priority = array($priority);
        }

        $sql_array = array();
        foreach ($priority as $priority_str) {
            switch ($priority_str) {
                case 'high' :
                    $sql_array[] = 't.priority = \'high\' ';
                    break;
                case '!high' :
                    $sql_array[] = 't.priority != \'high\' ';
                    break;
                case 'average' :
                    $sql_array[] = 't.priority = \'average\' ';
                    break;
                case '!average' :
                    $sql_array[] = 't.priority != \'average\' ';
                    break;
                case 'low' :
                    $sql_array[] = 't.priority = \'low\' ';
                    break;
                case '!low' :
                    $sql_array[] = 't.priority != \'low\' ';
                    break;
                default:
                    break;
            }
        }

        if(count($priority)) {
            $sql .= ' AND (';
        }

        $sql .= implode(' OR ', $sql_array);

        if(count($priority)) {
            $sql .= ') ';
        }

        if(is_string($kind)) {
            $kind = array($kind);
        }

        $sql_array = array();
        foreach ($kind as $kind_str) {
            switch ($kind_str) {
                case 'bug' :
                    $sql_array[] = 't.kind = \'bug\' ';
                    break;
                case '!bug' :
                    $sql_array[] = 't.kind != \'bug\' ';
                    break;
                case 'implementation' :
                    $sql_array[] = 't.kind = \'implementation\' ';
                    break;
                case '!implementation' :
                    $sql_array[] = 't.kind != \'implementation\' ';
                    break;
                case 'change' :
                    $sql_array[] = 't.kind = \'change\' ';
                    break;
                case '!change' :
                    $sql_array[] = 't.kind != \'change\' ';
                    break;
                case 'task' :
                    $sql_array[] = 't.kind = \'task\' ';
                    break;
                case '!task' :
                    $sql_array[] = 't.kind != \'task\' ';
                    break;
                case 'proposal' :
                    $sql_array[] = 't.kind = \'proposal\' ';
                    break;
                case '!proposal' :
                    $sql_array[] = 't.kind != \'proposal\' ';
                    break;
                default:
                    break;
            }
        }

        if(count($kind)) {
            $sql .= ' AND (';
        }

        $sql .= implode(' OR ', $sql_array);

        if(count($kind)) {
            $sql .= ') ';
        }

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

}