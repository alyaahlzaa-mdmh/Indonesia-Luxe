<?php

namespace App\Livewire\Admin\Concerns;

use Livewire\WithPagination;

trait WithAdminPagination
{
    use WithPagination;

    public int $perPage = 10;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
}
