<?php

// app/Observers/OrganizerObserver.php

namespace App\Observers;

use App\Models\Organizer;
use Illuminate\Support\Facades\Log;

class OrganizerObserver
{
    // Кога се креира нов организатор
    public function created(Organizer $organizer): void
    {
        Log::info("🔔 НОВА НОТИФИКАЦИЈА: Организатор '{$organizer->full_name}' ({$organizer->email}) е успешно креиран.");
    }

    // Кога организаторот се ажурира
    public function updated(Organizer $organizer): void
    {
        Log::info("📝 ЛОГ: Организаторот ID:{$organizer->id} ('{$organizer->full_name}') е ажуриран.");

        // Дополнително логирање ако се смени email-от или телефонот
        if ($organizer->isDirty('email')) {
            Log::info("-> Променет е Email од {$organizer->getOriginal('email')} во {$organizer->email}.");
        }
    }

    // Кога организаторот се брише
    public function deleted(Organizer $organizer): void
    {
        Log::info("🗑️ ЛОГ: Организаторот ID:{$organizer->id} ('{$organizer->full_name}') е избришан од системот.");
    }

    // ... (може да додадете и restoring, forceDeleted ако се потребни)
}
