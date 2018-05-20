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
        Bouncer::allow('administrator')->to('questions_manage');
        Bouncer::allow('administrator')->to('survey_add');
        Bouncer::allow('administrator')->to('survey_browse');
        Bouncer::allow('administrator')->to('report_browse');
        Bouncer::allow('administrator')->to('debug_view');
        Bouncer::allow('user')->to('survey_add');
    }
}
