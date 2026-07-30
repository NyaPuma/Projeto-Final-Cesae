<?php

namespace Tests\Fixtures\Datasets;

class UserRoleDataset
{
    public static function roles(): array
    {
        return [
            'admin' => ['admin'],
            'technician' => ['technician'],
            'user' => ['user'],
        ];
    }

    public static function invalidRoles(): array
    {
        return [
            'superadmin' => ['superadmin'],
            'manager' => ['manager'],
            'empty' => [''],
            'null' => [null],
        ];
    }
}
