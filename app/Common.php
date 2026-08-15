<?php

if (! function_exists('admin_permissions')) {
    /**
     * @return list<string>
     */
    function admin_permissions(): array
    {
        $permissions = session()->get('admin_permissions');

        return is_array($permissions) ? $permissions : [];
    }
}

if (! function_exists('admin_can')) {
    function admin_can(string $permission): bool
    {
        $permissions = admin_permissions();

        return in_array('*', $permissions, true) || in_array($permission, $permissions, true);
    }
}

if (! function_exists('super_admin_role_slug')) {
    function super_admin_role_slug(): string
    {
        return 'super-admin';
    }
}

if (! function_exists('super_admin_owner_email')) {
    function super_admin_owner_email(): string
    {
        return 'admin@bloomkidswear.test';
    }
}

if (! function_exists('super_admin_role')) {
    function super_admin_role(): ?array
    {
        $role = db_connect()->table('roles')->where('slug', super_admin_role_slug())->get()->getRowArray();

        return $role ?: null;
    }
}

if (! function_exists('is_super_admin_role')) {
    function is_super_admin_role(?array $role): bool
    {
        return ($role['slug'] ?? '') === super_admin_role_slug();
    }
}

if (! function_exists('is_protected_super_admin_user')) {
    /**
     * @param array<string, mixed>|null $admin
     */
    function is_protected_super_admin_user(?array $admin): bool
    {
        if (! $admin) {
            return false;
        }

        return strcasecmp((string) ($admin['email'] ?? ''), super_admin_owner_email()) === 0;
    }
}
