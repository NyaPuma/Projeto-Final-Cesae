<?php

namespace Tests\Concerns;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;

trait CreatesEquipment
{
    protected function createEquipment(array $attributes = []): Equipment
    {
        $room = $attributes['room_id'] ?? Room::factory()->create();
        $category = $attributes['category_id'] ?? EquipmentCategory::factory()->create();

        return Equipment::factory()->create(array_merge([
            'room_id' => $room->id,
            'category_id' => $category->id,
        ], $attributes));
    }

    protected function createRoom(array $attributes = []): Room
    {
        return Room::factory()->create($attributes);
    }

    protected function createEquipmentCategory(array $attributes = []): EquipmentCategory
    {
        return EquipmentCategory::factory()->create($attributes);
    }

    protected function createEquipmentInRoom(Room $room, array $attributes = []): Equipment
    {
        return Equipment::factory()->create(array_merge([
            'room_id' => $room->id,
        ], $attributes));
    }

    protected function createEquipments(int $count, array $attributes = []): array
    {
        $equipments = [];
        for ($i = 0; $i < $count; $i++) {
            $equipments[] = $this->createEquipment($attributes);
        }

        return $equipments;
    }

    protected function createRooms(int $count, array $attributes = []): array
    {
        $rooms = [];
        for ($i = 0; $i < $count; $i++) {
            $rooms[] = $this->createRoom($attributes);
        }

        return $rooms;
    }
}
