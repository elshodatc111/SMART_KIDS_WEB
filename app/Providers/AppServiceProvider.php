<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider{
    
    public function register(): void{
        //
    }

    public function boot(): void{
        Scramble::afterOpenApiGenerated(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer')
            );
        });
        View::composer('layouts.partials.header', function ($view) {
            $LeadCount = 5;
            $tkun = 6;
            $view->with([
                'header_leads' => $LeadCount,
                'header_tkun' => $tkun
            ]);
        });
    }
}
