<?php
/**
 * Config - an example for setting up system settings.
 * When you are done editing, rename this file to 'Config.php'.
 *
 * @author David Carr - dave@daveismyname.com
 * @author Edwin Hoksberg - info@edwinhoksberg.nl
 * @version 3.0
 */

namespace App;

use Helpers\Session;

/**
 * Configuration constants and options.
 */
class Config
{
    /**
     * Executed as soon as the framework runs.
     */
    public function __construct()
    {
        /**
         * Turn on output buffering.
         */
        ob_start();

        /**
         * Define the complete site URL.
         */
        define('SITEURL', 'http://localhost/meuprojeto/');

        /**
         * Define relative base path.
         */
        define('DIR', '/meuprojeto/');

        /**
         * Set the Application Router.
         */
        // Default Routing
        define('APPROUTER', '\Core\Router');
        // Classic Routing
        // define('APPROUTER', '\Core\ClassicRouter');

        /**
         * Set default controller and method for legacy calls.
         */
        define('DEFAULT_CONTROLLER', 'Welcome');
        define('DEFAULT_METHOD', 'index');

        /**
         * Set the default template.
         */
        define('TEMPLATE', 'Default');

        /**
         * Set a default language.
         */
        define('LANGUAGE_CODE', 'pt-BR');

        //database details ONLY NEEDED IF USING A DATABASE

        /**
         * Database engine default is mysql.
         */
        define('DB_TYPE', 'mysql');

        /**
         * Database host default is localhost.
         */
        define('DB_HOST', 'localhost');

        /**
         * Database name.
         */
        define('DB_NAME', 'database');

        /**
         * Database username.
         */
        define('DB_USER', 'root');

        /**
         * Database password.
         */
        define('DB_PASS', '');

        /**
         * PREFER to be used in database calls default is smvc_
         */
        define('PREFIX', 'tbl_');

        /**
         * Set prefix for sessions.
         */
        define('SESSION_PREFIX', 'nova_');

        /**
         * Optional create a constant for the name of the site.
         */
        define('SITETITLE', 'Meu Projeto');

        /**
         * Optional set a site email address.
         */
        define('SITEEMAIL', 'contato@davidcosta.com.br');

        /**
         * Turn on custom error handling.
         */
        set_exception_handler('Core\Logger::ExceptionHandler');
        set_error_handler('Core\Logger::ErrorHandler');

        /**
         * Set timezone.
         */
        date_default_timezone_set('America/Recife');

        /**
         * Start sessions.
         */
        Session::init();


        $this->my_config();
    }


    public function my_config() {

        /**
         * Definindo o ip do usuário
         */
        if($_SERVER['REMOTE_ADDR'] == '::1') {
            $ipUsuario = '127.0.0.1';
        } else {
            $ipUsuario = $_SERVER['REMOTE_ADDR'];
        }
        define('IP_USUARIO', $ipUsuario);




        $id   = session_id();
        $name = session_name();


        $cookieAntes = filter_input(INPUT_COOKIE, 'user');

        if($cookieAntes != null && $cookieAntes != $id) {
            $id = $cookieAntes;
            setcookie($name, $id, time()+(62208000), '/', '', false, true);
            setcookie('user', $cookieAntes, time()+(62208000), '/', '', false, true);
        } else {
            setcookie('user', $id, time()+(62208000), '/', '', false, true);
        }


        define('SESSAO_USER', $id);


        $user = Session::get('user_id');
        if($user > 0) {
            define('USUARIO_ID', $user)  ;
        } else {
            define('USUARIO_ID', 0);
        }



        define('GOOGLE_ANALYTICS', "");

    }
}
