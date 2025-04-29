<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class PermissionRole extends SpatieRole
{
protected $table = 'permission_roles';
}