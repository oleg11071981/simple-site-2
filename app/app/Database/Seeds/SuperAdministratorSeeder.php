<?php

/** @noinspection PhpUnused */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuperAdministratorSeeder extends Seeder
{
    public function run()
    {
        $existing = $this->db->table('n_users')
            ->where('login', 'superadministrator')
            ->get()
            ->getRow();

        if ($existing) {
            echo "\n⚠️  Супер-администратор уже существует! (ID: {$existing->id})\n";
            return;
        }

        $password = env('ADMIN_INITIAL_PASSWORD');
        if (empty($password)) {
            $password = bin2hex(random_bytes(8));
            $generated = true;
        } else {
            $generated = false;
        }

        $data = [
            'name'           => 'Super Administrator',
            'login'          => 'superadministrator',
            'email'          => env('ADMIN_EMAIL', 'admin@example.com'),
            'password'       => password_hash($password, PASSWORD_DEFAULT),
            'description'    => 'Главный администратор системы с полными правами доступа',
            'site'           => '',
            'media'          => null,
            'publish'        => 1,
            'type'           => 1,
            'create'         => date('Y-m-d H:i:s'),
            'modify'         => date('Y-m-d H:i:s'),
            'create_by_user' => 0,
            'modify_by_user' => 0,
        ];

        $this->db->table('n_users')->insert($data);
        $id = $this->db->insertID();

        echo "\n✅ Супер-администратор создан (ID: {$id})\n";
        echo "   Логин: superadministrator\n";

        if ($generated) {
            echo "   Пароль (сохраните, больше не показывается): {$password}\n";
        } else {
            echo "   Пароль задан через ADMIN_INITIAL_PASSWORD\n";
        }

        echo "   Email: {$data['email']}\n\n";
    }
}
