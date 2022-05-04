<?php

use Illuminate\Support\Facades\Route;

Route::patch(
    '{resource}/{resourceId}/reorder',
    'PixelCreation\NovaFieldSortable\Http\Controllers\ResourceSortingController@handle'
);
