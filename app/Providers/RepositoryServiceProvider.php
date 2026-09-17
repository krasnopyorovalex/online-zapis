<?php

namespace App\Providers;

use App\Domain\Repositories\Contracts\CompanyRepositoryInterface;
use App\Domain\Repositories\Eloquent\EloquentCompanyRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /** @var array<class-string, class-string> */
    public array $bindings = [
        CompanyRepositoryInterface::class => EloquentCompanyRepository::class,
    ];
}
