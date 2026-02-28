<?php

namespace App\Providers;

use App\Models\Kid;
use App\Models\LeadEmployee;
use App\Models\LeadKid;
use App\Models\User;
use Carbon\Carbon;
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
            $leadEmploes = count(LeadEmployee::where('status','new')->get());
            $leadKids = count(LeadKid::where('status','new')->get());
            $LeadCount = $leadEmploes + $leadKids;
            $today = Carbon::now();
            $birthdayCount = User::where('status', 'active')->whereMonth('birthday', $today->month)->whereDay('birthday', $today->day)->count();
            $query = Kid::where('status', '!=', 'delete')->whereMonth('tkun', $today->month)->whereDay('tkun', $today->day);
            $tkun = $birthdayCount + $query->count();
            $view->with([
                'header_leads' => $LeadCount,
                'header_tkun' => $tkun
            ]);
        });
    }
}
