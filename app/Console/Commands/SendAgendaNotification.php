<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\AgendaReminderNotification;
use App\Models\Agenda;
use App\Models\User;
use Carbon\Carbon;


class SendAgendaNotification extends Command
{
    protected $signature = 'agenda:send-notification';
    protected $description = 'Send notification for upcoming agenda';

    public function handle()
    {
        $todayAgendas = Agenda::whereDate('tanggal_kegiatan', Carbon::today())->get();

        foreach ($todayAgendas as $agenda) {
            $user = User::where('role', 2)->first();
            if ($user){
                $user->notify(new AgendaReminderNotification($agenda));
            }
        }

        $this->info('Agenda notifications sent successfully.');
    }
}
