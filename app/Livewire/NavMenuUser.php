<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class NavMenuUser extends Component
{
    public $count_cart = 0;
    protected $listeners = ['counterUpdated'];

    public function mount()
    {
        // Your code here
        if(Auth::check()) {
            $this->getCounter();
        }
    }

    public function counterUpdated($data)
    {
        $this->count_cart = $data['count_cart'];
    }


    public function render()
    {
        return view('livewire.nav-menu-user');
    }

    public function getCounter()
    {
        $request = Request::create(route('api.getCountUserCart', ['user_id'=>Auth::user()->id]), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);
        $this->count_cart = $respponseBody['count_cart'];
    }
}
