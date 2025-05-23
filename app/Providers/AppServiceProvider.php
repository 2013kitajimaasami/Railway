<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // 1人のユーザーが複数の権限を持っている可能性があるため foreach で role をひとつずつ取り出す
        Gate::define('admin', function($user) {
            foreach($user->roles as $role){
                if($role->name == 'admin') {
                    return true;
                }
            }
            return false;
        });

        Gate::define('user',function($user){
            foreach($user->roles as $role){
                if($role->name=='user'){
                    return true;
                }
            }
            return false;
        });

        Gate::define('free',function($user){
            foreach($user->roles as $role){
                if($role->name=='free'){
                    return true;
                }
            }
            return false;
        });

    }
}
