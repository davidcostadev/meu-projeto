<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @version 3.0
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;
use Helpers\Session;

/** Define static routes. */

// Default Routing
//



Router::post('user/logar', 'App\Controllers\User@logar');

Router::post('task/add', 'App\Controllers\Task@add');
Router::any('task/save/', 'App\Controllers\Task@save');
Router::any('task/edit/(:num)', 'App\Controllers\Task@edit');
Router::any('task/details/(:num)', 'App\Controllers\Task@details');
Router::any('tasks', 'App\Controllers\Task@index');

Router::any('project/add', 'App\Controllers\Project@add');
Router::any('project/save', 'App\Controllers\Project@save');

Router::any('subpage', 'App\Controllers\Welcome@subPage');
Router::any('admin/(:any)(/(:any)(/(:any)(/(:any))))', 'App\Controllers\Demo@test');
/** End default routes */


//Router::any('start', function() {

$user_id = Session::get('user_id');

if(empty($user_id)) {
    Router::any('', 'App\Controllers\User@login');

} else {
    Router::any('', 'App\Controllers\Welcome@index');
}
//});

/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');
/** End Module routes. */

/** If no route found. */
Router::error('Core\Error@index');
