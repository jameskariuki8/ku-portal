<?php
namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    public static function redirectToDashboard(Request $request)
    {
        if ($request->user()->role === 'teacher') {
            return route('teacher.dashboard');
        } elseif ($request->user()->role === 'admin') {
            return route('admin.dashboard');
        }
        return route('student.dashboard');
    }
}
