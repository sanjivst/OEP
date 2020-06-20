<?php

Route::group(
    ['middleware' => ['web', 'auth', 'checkRole'], 'prefix' => 'admin'], function()
    {
        Route::resource('courses', 'Globali\Course\CourseController');
    });