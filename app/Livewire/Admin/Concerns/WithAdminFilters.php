<?php

namespace App\Livewire\Admin\Concerns;

trait WithAdminFilters
{
    public string $search = '';

    public string $statusFilter = '';

    public function clearFilters(): void
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->resetPage(); // Dependent on WithAdminPagination
    }
}
