<?php

namespace App\Controllers;

use App\Database\QueryBuilder;
use App\Middlewares\CheckAccessMiddleware;
use App\Traits\ResponseTrait;
use App\Validations\ValidateData;

class Controller
{
    use ResponseTrait;
    use ValidateData;

    protected $queryBuilder;
    protected $Access;

    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder();
        $this->Access       = new CheckAccessMiddleware();
    }
}