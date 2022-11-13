<?php

namespace App\Http\Livewire;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\User;

class Patients extends Component
{
    public function render()
    {

        // $request = Request::create('/api/v1/patient', 'GET');
        // $response = Route::dispatch($request);

        // $request->header->set('Authorization', 'Bearer '.'47|3TYQjddAAOr6SpoCOl1BiYaimUvqo2IljiGLTSSf');

        // $responseBody = json_encode($response->getContent(), true);
        // $patient = $responseBody["data"][0]["result"];

        // return view('livewire.patients', compact('patient'));
        // return view('livewire.patients', [
        //     'patient' => "Patient data"
        // ]);

        // $product = Product::with('users','users')->orderBy('id', 'desc')->paginate(25);
        return view('livewire.patients', [
            // 'product' => $product,
            'users' => User::latest()->paginate(10),
            'aaaa' => "aaaa"
        ]);
    }
}
