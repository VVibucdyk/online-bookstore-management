<?php

namespace App\Livewire;

use App\Models\CartUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class ListCartItem extends Component
{
    public $total, $dataCart;

    public function mount()
    {
        // Your code here
        if(Auth::check()) {
            $this->getListCart();
        }
    }
    
    public function render()
    {
        return view('livewire.list-cart-item');
    }

    function getListCart() {
        $request = Request::create(route('api.getListCartItem', ['user_id'=>Auth::user()->id]), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);
        $items = $respponseBody['data_cart'];
        $this->dataCart = $items;
        $this->total = $items;
    }

    function decreaceCart($id, $book_id){
        $request = Request::create(route('api.decreaseCart', ['user_id'=>$id, 'book_id'=>$book_id]), 'post');
        $response = Route::dispatch($request);


        $request = Request::create(route('api.getCountUserCart', ['user_id'=>$id]), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);

        // $this->emit('updateBubleBadge', $respponseBody);
        $this->dispatch('counterUpdated', $respponseBody);
        $this->reset();
        $this->getListCart();
    }

    function insertCart($id, $book_id){
        $request = Request::create(route('api.insertCart', ['user_id'=>$id, 'book_id'=>$book_id]), 'post');
        $response = Route::dispatch($request);


        $request = Request::create(route('api.getCountUserCart', ['user_id'=>$id]), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);

        // $this->emit('updateBubleBadge', $respponseBody);
        $this->dispatch('counterUpdated', $respponseBody);
        $this->reset();
        $this->getListCart();
    }

    function removeCart($id, $book_id){
        $request = Request::create(route('api.removeCart', ['user_id'=>$id, 'book_id'=>$book_id]), 'post');
        $response = Route::dispatch($request);


        $request = Request::create(route('api.getCountUserCart', ['user_id'=>$id]), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);

        // $this->emit('updateBubleBadge', $respponseBody);
        $this->dispatch('counterUpdated', $respponseBody);
        $this->reset();
        $this->getListCart();
    }
}
