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
            self::OpenTrip => 'Private Island Tours',
            self::PrivateTour => 'Boat & Snorkeling Charters',
            self::HikingCamping => 'Scenic Volcano & Jeep Tours',
            self::Rafting => 'Nature & River Rafting',
            self::SnorkelingDiving => 'Wellness & Resort Stays',
            self::JeepAdventure => 'Local Culture & Heritage',
            self::LocalExperience => 'Authentic Local Dining',
        };
    }
}
