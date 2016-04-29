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
class Project extends Controller
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

        $this->userConfig    = new \App\Models\User\UserConfig();
        $this->projectConfig = new \App\Models\Project\ProjectConfig();
        $this->projectTable  = new \App\Models\Project\ProjectTable();
        $this->groupConfig   = new \App\Models\Group\GroupConfig();
    }

    /**
     * Define Index page title and load template files
     */
    public function index() {

        $data['title']         = 'Projetos';
        $data['return_url']    = 'projects';

        // Filtros

        $data['filtro']['project_id'] = input::get('project_id', 0, FILTER_SANITIZE_NUMBER_INT);
        $data['filtro']['own_id']     = input::get('user_id', 0, FILTER_SANITIZE_NUMBER_INT);
 
        $user_id = Session::get('user_id');

        $filtros = array();

        $filtro[] = "(p.own_id = user_id OR r.user_id = user_id)";

        if($data['filtro']['project_id'] > 0) {
            $filtros[] = 'p.project_id = '.$data['filtro']['project_id'];
        }
        if($data['filtro']['own_id'] > 0) {
            $filtros[] = 'p.own_id = '.$data['filtro']['own_id'];
        }


        $this->projectTable->setFiltros($filtros);
        $this->projectTable->setOrderBy([
            'p.updated_on' => 'DESC'
        ]);
        $data['projects'] = $this->projectTable->getList();

        // Lista de Usuarios

        $usersObject = $this->userConfig->getUsers();

        $data['users'] = array();

        if(count($usersObject) > 0) {
            foreach ($usersObject as $user) {
                $data['users'][$user->user_id] = $user->name;
            }
        }

        // View

        View::renderTemplate('header', $data);
        View::render('Project/List', $data);
        View::renderTemplate('footer', $data);
    }

    public function details($project_id) {

        $user_id = Session::get('user_id');

        $data['project'] = $this->projectConfig->getProject($project_id, $user_id);

        if(!$data['project']) {
             Url::redirect('');
        }


        $data['title']          = 'Detalhes do Projeto: #'.$data['project']->id;
        $data['return_url']     = 'project/details/'.$data['project']->id;


        // Lista de na Equipe

        $data['group'] = $this->groupConfig->getGroups([
            'project_id' => $project_id,
          //  'user_id'    => $user_id
        ]);

        // echo '<pre>';
        // print_r($data['group']);

        $usersObject = $this->userConfig->getUsers([
            'project_id' => $project_id,
            'not_own_id' => true
        ]);

        // print_r($data['users']);
        // die();
        // // Lista de Usuarios

        // $usersObject = $this->userConfig->getUsers();


        // $data['users'] = array();

        if(count($usersObject) > 0) {
            foreach ($usersObject as $user) {
                $data['users'][$user->user_id] = $user->name;
            }
        }


        View::renderTemplate('header', $data);
        View::render('Project/Details', $data);
        View::render('Models/AddUserGroup', $data);
        View::renderTemplate('footer', $data);
    }

    public function edit($project_id) {

        $user_id = Session::get('user_id');

        $data['project'] = $this->projectConfig->getProject($project_id, $user_id);

        if(!$data['project']) {
             Url::redirect('');
        }


        $data['title']         = 'Editar Projeto: #'.$data['project']->id;
        $data['return_url']    = 'project/edit/'.$data['project']->id;


        $usersObject = $this->userConfig->getUsers();

        $data['users'] = array();

        if(count($usersObject) > 0) {
            foreach ($usersObject as $user) {
                if($user->id != $data['project']->project_id) {
                    $data['users'][$user->user_id] = $user->name;
                }

                
            }
        }


        View::renderTemplate('header', $data);
        View::render('Project/Edit', $data);
        View::renderTemplate('footer', $data);
    }

    public function add() {

        $data['title']          = 'Adicionar Projeto';
        $data['welcomeMessage'] = $this->language->get('subpageMessage');
        $data['return_url']     = 'project/add';

        $usersObject = $this->userConfig->getUsers();


        $data['users'] = array();

        if(count($usersObject) > 0) {
            foreach ($usersObject as $user) {
                $data['users'][$user->user_id] = $user->name;
            }
        }


        View::renderTemplate('header', $data);
        View::render('Project/Add', $data);
        View::renderTemplate('footer', $data);
    }

    public function save() {

        $data['project_id']  = input::get('project_id', 0, FILTER_SANITIZE_NUMBER_INT);
        $data['own_id']      = input::get('own_id', 0, FILTER_SANITIZE_NUMBER_INT);
        $data['project']     = input::get('project');
        $data['description'] = input::get('description');
        $url                 = input::get('return', null, FILTER_SANITIZE_URL);


        if($data['project_id'] > 0) {
            $result   = $this->projectConfig->updateProject($data);    
        } else {
            $result   = $this->projectConfig->addProject($data);    
        }
   
        if(!empty($url)) {
            Url::redirect($url);
        } else {
            Url::redirect('');
        }
    }
    
}
