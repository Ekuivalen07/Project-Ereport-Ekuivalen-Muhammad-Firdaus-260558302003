<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
abstract class AdminPage extends Component
{
    public function boot(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }
}
