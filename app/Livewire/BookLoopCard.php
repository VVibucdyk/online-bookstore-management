<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class BookLoopCard extends Component
{
    public $books;
    public $counterValue = 0;
    protected $listeners = ['searchBooksResult'];

    function addToCart($id = null, $book_id = null) {
        $request = Request::create(route('api.insertCart', ['user_id'=>$id, 'book_id'=>$book_id]), 'post');
        $response = Route::dispatch($request);


        $request = Request::create(route('api.getCountUserCart', ['user_id'=>$id]), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);

        $this->dispatch('counterUpdated', $respponseBody);
    }

    public function searchBooksResult($data)
    {
        $this->books = $data['books'];
    }

    public function render()
    {
        return view('livewire.book-loop-card');
    }
}
