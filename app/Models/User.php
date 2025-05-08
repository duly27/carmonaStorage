<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Asegúrate de incluir el campo 'role'
    ];

    /**
     * Los atributos que deben estar ocultos para los arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * agregamos los roles de los usuarios
     */

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function hasAnyRole(array $roles)
    {
        return in_array($this->role, $roles);
    }

    public function deleteUser()
    {
        return $this->delete();
    }

    /**
     * Crea un usuario si no existe.
     *
     * @param array $data
     * @return User|null
     */
    public static function createIfNotExists(array $data)
    {
        // Verifica si el usuario ya existe
        $user = self::where('email', $data['email'])->first();

        if ($user) {
            return null; // Retorna null si el usuario ya existe
        }

        // Crea y retorna el usuario si no existe
        return self::create($data);
    }

}
