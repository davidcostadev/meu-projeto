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

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class User extends Controller
{
    
    private $userConfig;

    /**
     * Call the parent construct
     */
    public function __construct() {
        parent::__construct();

        $this->userConfig = new \App\Models\User\UserConfig();
    }

    /**
     * Define Index page title and load template files
     */
    public function index() {
        $data['title'] = 'Dashboard';
        $data['welcomeMessage'] = $this->language->get('welcomeMessage');

        View::renderTemplate('header', $data);
        View::render('User/Login', $data);
        View::renderTemplate('footer', $data);
    }

    /**
     * Define Subpage page title and load template files
     */
    public function login() {
        $data['title'] = 'Login';

        View::renderTemplate('login_header', $data);
        View::render('User/Login', $data);
        View::renderTemplate('login_footer', $data);
    }

    public function logar() {

        $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $result   = $this->userConfig->logar(array(
            'email'    => $email,
            'password' => $password
        ));


        if($result > 0) {
            Url::redirect('');
        }
    }
    
}
