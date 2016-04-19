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

        $this->userConfig    = new \App\Models\User\userConfig();
        $this->projectConfig = new \App\Models\Project\projectConfig();

    }

    public function add() {

        $data['title']          = 'Adicionar Projeto';
        $data['welcomeMessage'] = $this->language->get('subpageMessage');
        $data['return_url']     = 'project/add';

        $usersObject = $this->userConfig->getUser();


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
