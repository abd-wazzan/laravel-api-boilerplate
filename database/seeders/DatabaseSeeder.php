<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Client\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /*
    |--------------------------------------------------------------------------
    | Seeding Strategy
    |--------------------------------------------------------------------------
    |
    | In order to maintain your seeders working even after production, try to check for seeded data
    | existence in the database before seeding it. This can help you in development to avoid
    | a database refreshing when seeding new data and will also prevent duplicated data.
    |
    */

    public function run(): void
    {
        // production seeders.
        $this->call([
            UserSeeder::class,
        ]);



        /*
        |--------------------------------------------------------------------------
        | Disable ForeignKey Constraints
        |--------------------------------------------------------------------------
        |
        | Disabling foreign key constraints give flexibility to your testing seeders, but
        | it may result data inconsistency. so be careful if you decide to disable them.
        |
        */
        if (app()->environment(['local', 'staging', 'testing'])) {
//            Schema::disableForeignKeyConstraints();
            $this->call(TestingSeeder::class);
//            Schema::enableForeignKeyConstraints();
        }
    }
}
