<?php

use Illuminate\Database\Seeder;
use Iplan\Entity\AccountStatus;

class AccountStatusSeeder extends Seeder
{
    /**
     * Account Statues.
     *
     * @var array
     */
    protected $statuses = [
        'active',
        'unconfirmed',
        'blocked'
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->statuses as $status) {
            AccountStatus::create([
                'status' => $status
            ]);
        }
    }
}
