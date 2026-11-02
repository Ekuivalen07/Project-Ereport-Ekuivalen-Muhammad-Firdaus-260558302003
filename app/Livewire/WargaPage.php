<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
abstract class WargaPage extends Component
{
    public function boot(): void
    {
        abort_unless(auth()->user()?->role === 'warga', 403);
    }
}
