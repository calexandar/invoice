<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\InvoiceSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            CompanySeeder::class,
            InvoiceSeeder::class,
        ]);
    }
}
