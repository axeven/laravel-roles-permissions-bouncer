<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('administrator')->to('users_manage');
        Bouncer::allow('administrator')->to('propinsi_manage');
        Bouncer::allow('administrator')->to('company_income_manage');
        Bouncer::allow('administrator')->to('company_size_manage');
        Bouncer::allow('administrator')->to('company_model_manage');
        Bouncer::allow('administrator')->to('company_field_manage');
        Bouncer::allow('administrator')->to('questions_manage');
    }
}
