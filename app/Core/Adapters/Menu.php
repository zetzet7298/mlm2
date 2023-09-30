<?php

namespace App\Core\Adapters;

use App\Core\AccountConstant;
use TCG\Voyager\Models\Role;

/**
 * Adapter class to make the Metronic core lib compatible with the Laravel functions
 *
 * Class Menu
 *
 * @package App\Core\Adapters
 */
class Menu extends \App\Core\Menu
{
    public function build()
    {
        ob_start();

        parent::build();

        return ob_get_clean();
    }

    /**
     * Filter menu item based on the user permission using Spatie plugin
     *
     * @param $array
     */
    public static function filterMenuPermissions(&$array)
    {
        
        if (!is_array($array)) {
            return;
        }

        $user = auth()->user();
        // $admin_user = Role::where('name', 'admin')->orWhere('name', 'user')->pluck('id')->toArray();
        $admin_user = [1,2];
        $admin = 1;
        // check if the spatie plugin functions exist

        // if (!method_exists($user, 'hasAnyPermission') || !method_exists($user, 'hasAnyRole')) {
        // // dd($user);
        //     return;
        // }

        foreach ($array as $key => &$value) {
            if (is_callable($value)) {
                continue;
            }
            // if (isset($value['permission']) && !$user->hasAnyPermission((array) $value['permission'])) {
            //     unset($array[$key]);
            // }

            if (isset($value['role']) && isset($user->role_id)) {
        // 
                if($value['role'] == 'admin|user'){
                    if(!in_array($user->role_id, $admin_user)){
                        unset($array[$key]);
                    }
                }elseif($value['role'] == 'admin|member'){
                    if($user->role_id == 1 || $user->type == AccountConstant::TYPE_USER_MEMBER){
                        continue;
                    }else{
                        unset($array[$key]);
                    }
                }
                elseif($value['role'] == 'admin'){
                    if($user->role_id != 1){
                        unset($array[$key]);
                    }
                }
            }

            // if (isset($value['role_or_permission'])) {
            //     $explode = explode('|', $value['role_or_permission']);
            //     $role = $explode[0]; $permission = $explode[1];
            //     if($user->hasRole($role) || $user->can($permission)){
            //         continue;
            //     }else{
            //         unset($array[$key]);
            //     }
            // }

            if (is_array($value)) {
                self::filterMenuPermissions($value);
            }
        }
    }
}
