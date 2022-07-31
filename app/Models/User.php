<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function authenticate(Request $request): string|bool
    {
        $user = User::where('name', $request->login)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return false;
        } else {
            Auth::attempt(['name' => $request->login, 'password' => $request->password]);
            return $user->createToken('token')->plainTextToken;
        }
    }
}
