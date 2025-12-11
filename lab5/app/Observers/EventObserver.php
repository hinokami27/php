<?php

// app/Observers/EventObserver.php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventObserver
{
    // Кога се креира нов настан
    public function created(Event $event): void
    {
        Log::info("📢 СИСТЕМСКА ПОРАКА: Додаден е нов настан: '{$event->name}' (Тип: {$event->type}).");
    }

    // Кога настанот се ажурира
    public function updated(Event $event): void
    {
        Log::info("📝 ЛОГ: Настанот ID:{$event->id} ('{$event->name}') е ажуриран.");

        // Проверка дали е променет датумот
        if ($event->isDirty('date_time')) {
            Log::info("-> Датумот на настанот е променет: од {$event->getOriginal('date_time')} во {$event->date_time}.");
        }
    }

    // Кога настанот се брише
    public function deleted(Event $event): void
    {
        Log::info("❌ ЛОГ: Настанот '{$event->name}' (ID:{$event->id}) е ОТКАЖАН и избришан од базата.");
    }

    // ...
}
