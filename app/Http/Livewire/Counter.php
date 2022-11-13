<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{

    public $counter = 0;

    public function render()
    {
        return view('livewire.counter');
    }

    public function increment()
    {
        // dd("hello livewire");
        $this->counter++;
    }

    public function decrement()
    {
        $this->counter--;
    }
    public function resetCounter()
    {
        $this->counter = 0;
    }

}
