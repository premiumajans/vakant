<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'slider',
            'categories',
            'languages',
            'settings',
            'seo-tags',
            'users',
            'permissions',
            'information',
            'newsletter',
            'alt-categories',
            'vacancy',
            'news',
            'faq',
            'city',
            'salary',
            'education',
            'experience',
            'mode',
            'packages',
        ];
        foreach ($permissions as $permission) {
            addPermission($permission);
        }
        $singlePermissions = [
            'about index',
            'about edit',
            'dashboard index',
            'term index',
            'term edit',
            'appeals index',
            'appeals delete',
        ];
        foreach ($singlePermissions as $single) {
            $singPer = new \Spatie\Permission\Models\Permission();
            $singPer->name = $single;
            list($group) = explode(' ', $single);
            $singPer->group_name = $group;
            $singPer->guard_name = 'web';
            $singPer->save();
        }
    }
}
