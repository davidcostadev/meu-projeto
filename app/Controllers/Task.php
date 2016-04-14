<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Url;
use Helpers\Session;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Task extends Controller
{
    
    private $userConfig;
    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();

        if(empty(Session::get('user_id'))) {
            Url::redirect('');
        }

        $this->taskConfig = new \App\Models\Task\TaskConfig();
        $this->taskTable  = new \App\Models\Task\TaskTable();
    }

    /**
     * Define Index page title and load template files
     */
    public function index() {



        $data['title']          = 'Lista de Tarefas';
        $data['return_url']    = 'tasks';


        $this->taskTable->setFiltros([
            //'t.project_id =  1',
            //'(t.status = \'resolved\' OR t.status = \'closed\')',
        ]);
        $this->taskTable->setOrderBy([
            't.status',
            't.priority' => 'ASC',
            't.update_on' => 'ASC'
        ]);
        $data['tasks'] = $this->taskTable->getList();


        // print_r($data['tasks']);
        // die();

        View::renderTemplate('header', $data);
        View::render('Task/List', $data);
        View::renderTemplate('footer', $data);
    }

    public function details($params)
    {
        //die($params);

        $data['task'] = $this->taskConfig->getTask($params);

        if(!$data['task']) {
             Url::redirect('');
        }


        $data['title']          = 'Detalhes da Tarefa: #'.$data['task']->id;
        $data['welcomeMessage'] = $this->language->get('subpageMessage');
        $data['return_url']    = 'task/details/'.$data['task']->id;


        View::renderTemplate('header', $data);
        View::render('Task/Details', $data);
        View::renderTemplate('footer', $data);
    }

    public function add() {

        $data['project_id']  = filter_input(INPUT_POST, 'project_id');
        $data['task']        = filter_input(INPUT_POST, 'task');
        $data['description'] = filter_input(INPUT_POST, 'description');
        $data['status']      = filter_input(INPUT_POST, 'status');
        $data['priority']    = filter_input(INPUT_POST, 'priority');
        $data['kind']        = filter_input(INPUT_POST, 'kind');
        $url                 = filter_input(INPUT_GET, 'return');



        $result   = $this->taskConfig->add($data);


        if(!empty($url)) {
            Url::redirect($url);
        } else {
            Url::redirect('');
        }
    }

    public function edit() {

        if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $method = INPUT_POST;
        } else {
            $method = INPUT_GET;
        }


        $data['task_id']     = filter_input($method, 'task_id');
        $data['status']      = filter_input($method, 'status');
        $data['priority']    = filter_input($method, 'priority');
        $data['kind']        = filter_input($method, 'kind');
        $url                 = filter_input(INPUT_GET, 'return');



        $result   = $this->taskConfig->updateTask($data);


        if(!empty($url)) {
            Url::redirect($url);
        } else {
            Url::redirect('');
        }
    }
    
}
