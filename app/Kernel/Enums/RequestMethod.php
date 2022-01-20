<?php

namespace PHWolfCMS\Kernel\Enums;

enum RequestMethod:string {
    case POST = 'post';
    case GET = 'get';
    case ANY = 'any';
}