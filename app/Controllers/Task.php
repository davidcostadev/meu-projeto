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
use Helpers\Input as input;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Task extends Controller
{
    
    private $userConfig;

    /**
     * Call the parent construct
     */
    public function __construct() {
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

        $project_id = filter_input(INPUT_GET, 'project_id', FILTER_VALIDATE_INT);
        $kind       = filter_input(INPUT_GET, 'kind');
        $priority   = filter_input(INPUT_GET, 'priority');
        $status     = filter_input(INPUT_GET, 'status');


        $filtros = array();

        if($project_id > 0) {
            $filtros[] = 't.project_id = '.$project_id;
        }
        if(!empty($kind)) {
            $filtros[] = 't.kind = '.$this->taskTable->escape($kind);
        }
        if(!empty($priority)) {
            $filtros[] = 't.priority = '.$this->taskTable->escape($priority);
        }
        if(!empty($status)) {
            $filtros[] = 't.status = '.$this->taskTable->escape($status);
        }


        $this->taskTable->setFiltros($filtros
            //'t.project_id =  1',
            //'(t.status = \'resolved\' OR t.status = \'closed\')',
        );
        $this->taskTable->setOrderBy([
            't.status',
            't.priority' => 'ASC',
            't.update_on' => 'DESC'
        ]);
        $data['tasks'] = $this->taskTable->getList();


        // print_r($data['tasks']);
        // die();

        View::renderTemplate('header', $data);
        View::render('Task/List', $data);
        View::renderTemplate('footer', $data);
    }

    public function details($params) {
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

    public function edit($params) {

        $data['task'] = $this->taskConfig->getTask($params);

        if(!$data['task']) {
             Url::redirect('');
        }


        $data['title']          = 'Editar da Tarefa: #'.$data['task']->id;
        $data['welcomeMessage'] = $this->language->get('subpageMessage');
        $data['return_url']    = 'task/edit/'.$data['task']->id;


        View::renderTemplate('header', $data);
        View::render('Task/Edit', $data);
        View::renderTemplate('footer', $data);
    }

    public function add() {


        $data['title']          = 'Adicionar Tarefa';
        $data['welcomeMessage'] = $this->language->get('subpageMessage');
        $data['return_url']     = 'task/add';

        $projectObject = $this->projectConfig->getProjects();


        $data['projects'] = array();

        if(count($projectObject) > 0) {
            foreach ($projectObject as $project) {
                $data['projects'][$project->project_id] = $project->project . " / " . $project->user_name;
            }
        }

        View::renderTemplate('header', $data);
        View::render('Task/Add', $data);
        View::renderTemplate('footer', $data);
    }

    public function save() {

        $data['task_id']     = input::get('task_id', 0, FILTER_SANITIZE_NUMBER_INT);
        $data['project_id']  = input::get('project_id', 0, FILTER_SANITIZE_NUMBER_INT);
        $data['task']        = input::get('task');
        $data['description'] = input::get('description');
        $data['status']      = input::get('status');
        $data['priority']    = input::get('priority');
        $data['kind']        = input::get('kind');
        $url                 = input::get('return', null, FILTER_SANITIZE_URL);


        if($data['task_id'] > 0) {
            $result   = $this->taskConfig->updateTask($data);    
        } else {
            $result   = $this->taskConfig->addTask($data);    
        }
   
        if(!empty($url)) {
            Url::redirect($url);
        } else {
            Url::redirect('');
        }
    }
    
}
