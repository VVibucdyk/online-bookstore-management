<?php

namespace App\Livewire;

use App\Models\OrderTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class ListOrder extends Component
{

    public $dataOrder;

    function getListOrder() {
        
        $request = Request::create(route('api.getListOrderTransaction', ['user_id'=>Auth::user()->id]), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);
        $items = $respponseBody['data_order'];
        $this->dataOrder = $items;
    }

    public function mount()
    {
        // Your code here
        if(Auth::check()) {
            $this->getListOrder();
        }
    }
    
    public function render()
    {
        return view('livewire.list-order');
    }
}
