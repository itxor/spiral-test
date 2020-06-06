<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Request;

use Spiral\Filters\Filter;

class CreateUserRequest extends Filter
{
    protected const SCHEMA = [
        'username' => 'data:username',
    ];

    protected const VALIDATES = [
        'username' => [
            ['notEmpty']
        ]
    ];

    protected const SETTERS = [
        'username' => 'strval'
    ];
}
