<?php

namespace App\Services\Api\V1;

use App\Http\Requests\Api\V1\WaitlistRequest;
use App\Models\Waitlist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class WaitlistService
{
    public function store(WaitlistRequest $request): Waitlist
    {
        return DB::transaction(function () use ($request) {
            return Waitlist::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'company' => $request->company,
            ]);
        });
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Waitlist::all();
    }

    public function findById(int $id): Waitlist
    {
        $waitlist = Waitlist::find($id);
        if (!$waitlist) {
            throw new ModelNotFoundException('Waitlist entry not found');
        }
        return $waitlist;
    }
}
