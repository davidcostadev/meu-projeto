<?php
/**
 * Table - the base model
 *
 * @author David Costa - davidcosta@csthost.com.br
 * @version 3.0
 */

namespace Core;

use Core\Model;

abstract class Table extends Model {

    protected $page  = 0;
    protected $limit = 50;
    protected $filtros;
    protected $fields;
    protected $orderby;

    private $innerJoin;
    private $sql;
    private $quant;

    public function __construct() {
        parent::__construct();
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function setOrderBy($order = array()) {

        $interno = array();
        foreach ($order as $campo => $order) {
            if(is_numeric($campo)) {
                $interno[] = "$order ASC";
            } else {
                $interno[] = "$campo $order";
            }
        }

        $this->orderby = 'ORDER BY '. implode(", ", $interno);
    }

    public function setPage($page) {
        $this->page = ($page * $this->limit) - $this->limit;
    }

    protected function setFields($fields) {

        $interno = array();
        foreach ($fields as $key => $value) {
            if(is_numeric($key)) {
                $interno[] = "$value";
            } else {
                $interno[] = "$key AS $value";
            }
        }

        $this->fields = implode(",\n", $interno);

    }

    protected function get($table, $asTable = '') {

        if($asTable != '') {
            $tableAll = "$table AS $asTable";
        } else {
            $tableAll = $table;
        }

        if(count($this->innerJoin) > 1) {
            $this->innerJoin = implode("\n", $this->innerJoin);    
        } else {
            $this->innerJoin = $this->innerJoin[0];    
        }
 
        
        



        $sql = "SELECT 
        $this->fields
        FROM $tableAll 
        $this->innerJoin
        $this->filtros
        $this->orderby
        LIMIT $this->page,$this->limit";


        $this->executeQuant("$tableAll 
        $this->innerJoin
        $this->filtros");


        return $this->db->select($sql);
    }

    public function executeQuant($sql) {
        $result = $this->db->select('SELECT count(*) AS quant FROM ' . $sql);


        if(isset($result[0]->quant)) {
            $this->quant = $result[0]->quant;
        } else {
            $this->quant = 0;
        }
    }

    public function getQuant() {
        return $this->quant;
    }

    /**
     * innerJoin('tbl_produto','tbl_competidor', 'id_competidor')
     * innerJoin('tbl_produto','tbl_competidor', 'id_competidor', 'id_competidor')
     * innerJoin('tbl_produto', 'p', 'tbl_competidor', 'id_competidor', 'id_competidor')
     * innerJoin('tbl_produto', 'p', 'tbl_competidor', 'c','id_competidor', 'id_competidor')
     */
    protected function innerJoin($tableOne, $asTableOne, $tableTwo, $a, $b = null) {

        $this->innerJoin[] = "INNER JOIN $tableOne AS $asTableOne ON $asTableOne.$a=$tableTwo.$b";
    }

    protected function table($table) {
        
    }

    abstract public function setFiltros($filtros);

}