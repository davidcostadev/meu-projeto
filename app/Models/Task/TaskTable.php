<?php 

namespace App\Models\Task;

use Core\Table;

class TaskTable extends Table 
{    

    function __construct() {
        parent::__construct();

        $this->setFields([
            't.*',
            'p.project'     => 'project_name',
            'p.own_id'      => 'project_user_id',
            'c.name'        => 'client_name',
            'c.email'       => 'client_email',
            'c.id'          => 'client_id',
            'u.name'        => 'user_name',
            'u.email'       => 'user_email',
            'u.id'          => 'user_id',
        ]);
    }  

    public function setFiltros($filtros = array()) {

        if(count($filtros) == 0) {
            return;
        }


        $where = 'WHERE ';

        if(is_array($filtros)) {
            

            $campos = array();
            foreach ($filtros as $value) {

                $campos[] = $value;
            }

            $filtros = $where . implode(" \n\t\tAND ", $campos);    
        } else {
            $filtros = $where . $filtros;    
        }  


        $this->filtros = $filtros;


    }

    public function getList() {

        $this->innerJoin('tbl_user', 'u', 't', 'id', 'own_id');
        $this->innerJoin('tbl_project', 'p', 't', 'id', 'project_id');
        $this->innerJoin('tbl_user', 'c', 'p', 'id', 'own_id');

        $this->limit = 50;

        $result = $this->get('tbl_task', 't');

        return $result;

        if(count($result) == 0) {
            return array();
        }



        return $result;
    }
}