<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'=>'Marcos Vinicius dos Reis Alves',
                'department'=>'1',
                'role'=>'1',
                'email'=>'marcos@teste.com',
                'phone'=>'5534996832365',
                'cpf'=>	'13319702610',
                'password'=>bcrypt('12345'),
                'created_at'=>now(),	
                'updated_at'=>now(),
            ],
            [
                'name'=>'Guilherme Domingos Santos de Souza',
                'department'=>'3',
                'role'=>'3',
                'email'=>'guilherme@teste.com',
                'phone'=>'5534999687601',
                'cpf'=>	'12804234630',
                'password'=>bcrypt('12345'),
                'created_at'=>now(),	
                'updated_at'=>now(),
            ],
            [
                'name'=>'Pedro Lucas de Oliveira Cunha',
                'department'=>'2',
                'role'=>'2',
                'email'=>'pedro@teste.com',
                'phone'=>'5534999509814',
                'cpf'=>	'13319702612',
                'password'=>bcrypt('12345'),
                'created_at'=>now(),	
                'updated_at'=>now(),
            ]
        ]);
    }
}
