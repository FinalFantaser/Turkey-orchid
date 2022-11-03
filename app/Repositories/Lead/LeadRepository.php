<?php

namespace App\Repositories\Lead;

use App\Models\Lead;

class LeadRepository{
    public function create(string $name, string $phone): Lead
    {
        return Lead::create([
            'name' => $name,
            'phone' => $phone,
        ]);
    } //create

    public function updateOrCreate(string $name, string $phone): Lead
    {
        return Lead::updateOrCreate(
            [
                'name' => $name,
            ],
            [
                'phone' => $phone,
            ]
        );
    } //updateOrCreate

    public function remove(int|Lead $lead): void
    {
        if($lead instanceof Lead)
            $lead->delete();
        elseif(is_numeric($lead))
            Lead::where('id', $lead)->delete();
    } //remove
};

?>