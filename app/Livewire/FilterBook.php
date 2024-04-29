<?php

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class FilterBook extends Component
{
    public $search = '';
    public $category = '';

    function searchBooks() {
        $request = Request::create(route('api.getAllBooks', ['search'=>$this->search]), 'GET');
        $response = Route::dispatch($request);
        $respponseBody = json_decode($response->getContent(), true);

        $this->dispatch('searchBooksResult', ['books' => $respponseBody]);
    }
    public function render()
    {
        return view('livewire.filter-book');
    }
}
