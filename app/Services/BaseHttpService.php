<?php

namespace App\Services;

use App\Helpers\Response;

/**
 * Base HTTP service.
 */
abstract class BaseHttpService
{

    /**
     * @var \App\Helpers\Response
     */
    protected Response $response;

    /**
     *
     */
    public function __construct()
    {
        $this->response = new Response();
    }

}
