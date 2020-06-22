<?php

Route::group(
    ['middleware' => ['web', 'auth','checkRole'], 'prefix' => 'admin'], function()
{
    Route::resource('tutorials', 'Globali\Tutorial\TutorialController');    
});
