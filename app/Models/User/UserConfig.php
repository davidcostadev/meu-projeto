<?php 

namespace App\Models\User;

use Core\Model;
use Helpers\Session;
use Helpers\Password;

class UserConfig extends Model 
{    
    function __construct()
    {
        parent::__construct();
    }  

    public function Logar($params)
    {

        
        if(empty($params['email'])) {
            return -1;
        } elseif(empty($params['password'])) {
            return -2;
        }


        $sql = "SELECT * FROM tbl_user WHERE `email`=:email";
        $result = $this->db->select($sql, array(':email' => $params['email']));

        if(count($result) == 0) {
            return -3;
        }

        if(Password::verify($params['password'], $result[0]->password)) {

            Session::set('user_id', $result[0]->id);
            
            return true;
        } else {
            return -4;
        }


        return $this->db->select('SELECT 
            email, password
            FROM tbl_users'
        );
    }
}