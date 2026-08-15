<?php

namespace App\Enums;

enum PackageType: string
{
    case OpenTrip = 'open_trip';
    case PrivateTour = 'private_tour';
    case HikingCamping = 'hiking_camping';
    case Rafting = 'rafting';
    case SnorkelingDiving = 'snorkeling_diving';
    case JeepAdventure = 'jeep_adventure';
    case LocalExperience = 'local_experience';

    public function label(): string
    {
        return match ($this) {
            self::OpenTrip => 'Open Trip',
            self::PrivateTour => 'Private Tour',
            self::HikingCamping => 'Hiking / Camping',
            self::Rafting => 'Rafting',
            self::SnorkelingDiving => 'Snorkeling / Diving',
            self::JeepAdventure => 'Jeep Adventure',
            self::LocalExperience => 'Local Experience',
        };
    }
}
