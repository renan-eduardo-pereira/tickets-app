<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        $this->auditFields();
    }

    /**
     * auditFields
     * Creates created_by, updated_by, deleted_by
     * created_at, updated_at and deleted_at fields.
     *
     * @param  boolean  $softDeletes
     */
    public function auditFields()
    {

        return Blueprint::macro('auditFields', function ($softDeletes = true) {
            $this->string('created_by')->nullable();
            $this->string('updated_by')->nullable();
            $softDeletes == true ? $this->string('deleted_by')->nullable() : null;
            $this->timestamps();
            $softDeletes == true ? $this->softDeletes() : null;
        });
    }
}
