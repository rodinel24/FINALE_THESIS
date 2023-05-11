<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id',
        'room_status_id',
        'number',
        'capacity',
        'price',
        'view',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function roomStatus()
    {
        return $this->belongsTo(RoomStatus::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    
    public function getSingleRoomImage()
    {
        if ($this->single_room_image) {
            return asset('images/' . $this->single_room_image);
        }
        return asset('images/pixel_single.png');

    }


    public function firstImage()
{
    if (count($this->image) > 0) {
        $image = $this->image->first();
        if ($this->capacity <= 2) {
            return $image->getSingleRoomImage();
        } else if ($this->capacity <= 4) {
            return $image->getDoubleRoomImage();
        } else {
            return $image->getSuiteRoomImage();
        }
    }
    return asset('images/pixel_single.png');
}

}
