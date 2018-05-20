<?php

Route::get('/', 'HomeController@index')->name('home');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');
//register
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register/new', 'Auth\RegisterController@register')->name('register.new');
// survey
$this->get('company_profile', 'SurveyController@add')->name('survey.add');
$this->post('company_profile', 'SurveyController@record')->name('survey.record');
$this->get('company_analysis', 'ReportController@index')->name('survey.report');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('abilities', 'Admin\AbilitiesController');
    Route::post('abilities_mass_destroy', ['uses' => 'Admin\AbilitiesController@massDestroy', 'as' => 'abilities.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('tasks', 'TaskController');
    Route::post('tasks_mass_destroy', ['uses' => 'TasksController@massDestroy', 'as' => 'tasks.mass_destroy']);
    Route::get('questions', 'QuestionController@index')->named('questions');
    Route::post('questions/reorder', 'QuestionController@reorder')->named('questions.reorder');
    Route::resource('questions', 'QuestionController');
    Route::resource('answers', 'AnswerController');
});
