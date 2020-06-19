<?php

Route::group(
    ['middleware' => ['web', 'auth', 'checkRole'], 'prefix' => 'admin'], function()
    {
        Route::resource('students', 'Globali\Student\StudentController');
    });