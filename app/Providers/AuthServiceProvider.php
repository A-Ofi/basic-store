<?php

namespace App\Providers;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Helium\Jwt\Tokenizer;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Item' => 'App\Policies\ItemPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest("JWT", function (Request $request){
            try{
                $token = explode(" ",$request->header('Authorization'))[1];
                $payload = Tokenizer::decode($token);
                return User::where('email', $payload->email)->first();
            }catch(Exception $e){
                
            }
            
        });
    }
}
