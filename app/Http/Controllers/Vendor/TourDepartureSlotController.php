<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourDepartureSlotRequest;
use App\Http\Requests\UpdateTourDepartureSlotRequest;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;

class TourDepartureSlotController extends Controller
{
    public function store(StoreTourDepartureSlotRequest $request, TourPackage $tourPackage)
    {
        $this->authorize('update', $tourPackage);

        $tourPackage->slots()->create($request->validated());

        return back()->with('status', 'Slot keberangkatan berhasil ditambahkan.');
    }

    public function update(UpdateTourDepartureSlotRequest $request, TourDepartureSlot $tourDepartureSlot)
    {
        $this->authorize('update', $tourDepartureSlot->tourPackage);

        $tourDepartureSlot->update($request->validated());

        return back()->with('status', 'Slot keberangkatan berhasil diperbarui.');
    }

    public function destroy(TourDepartureSlot $tourDepartureSlot)
    {
        $this->authorize('update', $tourDepartureSlot->tourPackage);

        $tourDepartureSlot->delete();

        return back()->with('status', 'Slot keberangkatan berhasil dihapus.');
    }
}
