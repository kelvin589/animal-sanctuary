<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalController extends Controller
{
    /**
     * List all the animals
     */
    public function listAnimals() 
    {
        return view('/animals', array('animals' => Animal::all()));
    }
}