<?php 

namespace App\Models\Project;

use Core\Table;

class ProjectTable extends Table 
{    

    function __construct() {
        parent::__construct();

        $this->setFields([
            'p.*',
            // 'p.project'     => 'project_name',
            // //'p.description' => 'description',
            // 'p.own_id'      => 'project_user_id',
            // 'c.name'        => 'client_name',
            // 'c.email'       => 'client_email',
            // 'c.id'          => 'client_id',
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

        $this->innerJoin('tbl_user', 'u', 'p', 'id', 'own_id');
        $this->innerJoin('tbl_user_rel_project', 'r', 'p', 'project_id', 'id');

        $this->limit = 50;

        $result = $this->get('tbl_project', 'p');

        return $result;

        if(count($result) == 0) {
            return array();
        }



        return $result;
    }
}