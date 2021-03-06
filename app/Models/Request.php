<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Request extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['id', 'created_at', 'updated_at', 'animal_id', 'user_id', 'adoption_status'];

    /**
     * Get the animal associated with the request
     */
    public function animal()
    {
        return $this->hasOne(Animal::class);
    }

    /**
     * Get the user associated with the request
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Scope a query to only include pending requests.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('adoption_status', '=', 'pending');
    }

    /**
     * Scope a query to join users and animals names.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinTables($query)
    {
        return $query
            ->select('requests.id', 'users.username as user_name', 'animals.name as animal_name', 'requests.adoption_status', 'animals.image', 'requests.created_at', 'animals.description', 'animals.date_of_birth', 'requests.animal_id', 'requests.user_id', 'animals.type', 'users.forename', 'users.surname')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->join('animals', 'requests.animal_id', '=', 'animals.id');
    }

    /**
     * Scope a query to only include records with a certain animal_id.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAnimalID($query, $id)
    {
        return $query->where('animal_id', '=', $id);
    }

    /**
     * Scope a query to only include records with a certain user_id.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserID($query, $id)
    {
        return $query->where('requests.user_id', '=', $id);
    }

    /**
     * Scope a query to only include records with a certain animal_id and user_id.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAnimalIDUserID($query, $animal_id, $user_id)
    {
        return $query->where('requests.animal_id', '=', $animal_id)->where('requests.user_id', '=', $user_id);
    }
}
