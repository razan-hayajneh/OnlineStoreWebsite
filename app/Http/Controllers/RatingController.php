<?php

namespace App\Http\Controllers;

use App\DataTables\RatingDataTable;
use App\Repositories\RatingRepository;
use App\Http\Controllers\AppBaseController;

class RatingController extends AppBaseController
{
    public function index(RatingDataTable $ratingDataTable)
    {
        return $ratingDataTable->render('ratings.index');
    }
}
