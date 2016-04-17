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
use Helpers\Session;
use App\Models\Project\ProjectConfig;
use App\Models\Task\TaskConfig;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Welcome extends Controller
{

    /**
     * Call the parent construct
     */
    public function __construct() {
        parent::__construct();
        $this->language->load('Welcome');

        $this->projectConfig = new ProjectConfig();
        $this->taskConfig    = new TaskConfig();
    }

    /**
     * Define Index page title and load template files
     */
    public function index() {
        $data['title'] = 'Dashboard';
        $data['welcomeMessage'] = $this->language->get('welcomeMessage');
        $data['projects'] = 'Dashboard';



        $data['projects']   = $this->projectConfig->getProjects();
        $data['taskConfig'] = $this->taskConfig;

        $data['return_url']    = '';

        View::renderTemplate('header', $data);

        View::render('Welcome/Welcome', $data);
        View::render('Models/AddTask', $data);
        View::renderTemplate('footer', $data);
    }

    /**
     * Define Subpage page title and load template files
     */
    public function subPage() {
        $data['title'] = $this->language->get('subpageText');
        $data['welcomeMessage'] = $this->language->get('subpageMessage');

        View::renderTemplate('header', $data);
        View::render('Welcome/SubPage', $data);
        View::renderTemplate('footer', $data);
    }
}
