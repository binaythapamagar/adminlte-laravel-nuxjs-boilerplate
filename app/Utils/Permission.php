<?php
namespace App\Utils;

use Auth;
use App\PermissionReference;

class Permission
{
    // CHECKING USER PERMISSION TO ACCESS THE MODULE
    public static function checkPermission ( $module_name = null )
    {
        try {

            if ( $module_name == null ) {
                return false;
            }

            if ( !Auth::guard('admin')->check() ) {
                return false;
            }

            // if super admin return true;
            if ( Auth::guard('admin')->user()->user_is_superadmin->count() > 0 ) {
                return true;
            }

            $module_details = PermissionReference::with('permission_groups')->where('code', $module_name)->first();
            if ( !$module_details ) {
                return false;
            }

            $permission_grp_ids = $module_details->permission_groups ? $module_details->permission_groups->pluck('group_id')->toArray() : [];
            $user_grp_ids = Auth::guard('admin')->user()->user_group ? Auth::guard('admin')->user()->user_group->pluck('group_id')->toArray() : [];

            return count(array_intersect($permission_grp_ids, $user_grp_ids)) > 0 ? true : false;

        } catch (\Exception $e) {
            return false;
        }
    }
}