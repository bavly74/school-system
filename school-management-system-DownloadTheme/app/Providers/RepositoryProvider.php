<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\TeacherRepoInterface',
            'App\Repository\TeacherRepo',

        );

        $this->app->bind(
            'App\Repository\StudentRepoInterface',
            'App\Repository\StudentRepo',

        );

        $this->app->bind(
            'App\Repository\StudentPromotionRepoInterface',
            'App\Repository\StudentPromotionRepo',

        );

        $this->app->bind(
            'App\Repository\StudentGraduatedRepoInterface',
            'App\Repository\StudentGraduatedRepo',

        );

        $this->app->bind(
            'App\Repository\FeesRepoInterface',
            'App\Repository\FeesRepo',

        );

        $this->app->bind(
            'App\Repository\FeesInvoiceRepoInterface',
            'App\Repository\FeesInvoiceRepo',

        );

        $this->app->bind(
            'App\Repository\ReceiptStudentRepoInterface',
            'App\Repository\ReceiptStudentRepo',

        );

        $this->app->bind(
            'App\Repository\ProcessingFeesRepoInterface',
            'App\Repository\ProcessingFeesRepo',

        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
