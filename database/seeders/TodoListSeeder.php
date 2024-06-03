<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追記

use function PHPSTORM_META\map;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('todo_lists')->insert(
        [
            [
                'name' => 'テスト1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'テスト2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]
    );
    }
}
