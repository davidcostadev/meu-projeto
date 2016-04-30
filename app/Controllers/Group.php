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
class Group extends Controller
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

        $this->groupConfig = new \App\Models\Group\GroupConfig();
    }

    public function save() {

        $data['project_id']  = input::post('project_id', 0, FILTER_SANITIZE_NUMBER_INT);
        $data['user_id']     = input::post('user_id', 0, FILTER_SANITIZE_NUMBER_INT);
        $data['permission']  = input::post('permission');
        $url                 = input::get('return', null, FILTER_SANITIZE_URL);

        $result   = $this->groupConfig->addGroup($data);
   
        if(!empty($url)) {
            Url::redirect($url);
        } else {
            Url::redirect('');
        }
    }
    
}
