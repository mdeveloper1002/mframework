<?php

namespace Mdeveloper1002\Mframework\Routing;

use Buki\Router\Http\Controller;
use Mdeveloper1002\Mframework\View;

class BaseController extends Controller
{
    public function redirect($path): void
    {
        header("Location: $path");
        exit();
    }

    public function render($view, $data = []): void
    {
        View::render($view, $data);
    }
}