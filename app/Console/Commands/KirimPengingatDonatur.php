<?php

namespace App\Console\Commands;

use App\Mail\PengingatDonasi;
use App\Models\DataJamaah;
use App\Models\DonaturTetap;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class KirimPengingatDonatur extends Command
{
    protected $signature = 'pengingat:donatur';
    protected $description = 'Kirim email pengingat ke donatur tetap';

    public function handle()
    {
        $donaturs = DonaturTetap::all();
        $today = now();

        foreach ($donaturs as $donatur) {
            // Ambil data jamaah saat dibutuhkan
            $jamaah = DataJamaah::where('uuid', $donatur->uuid_user)->first();

            if (!$jamaah || !$jamaah->email) {
                Log::warning("Data jamaah tidak ditemukan atau tidak ada email untuk UUID {$donatur->uuid_user}");
                continue;
            }

            $interval = match ($donatur->frekuensi) {
                'Harian' => 1,
                'Mingguan' => 7,
                'Bulanan' => 30,
                default => null,
            };

            if (!$interval) {
                Log::warning("Frekuensi tidak valid untuk donatur UUID {$donatur->uuid_user}");
                continue;
            }

            $nextReminder = optional($donatur->last_reminder_send)->addDays($interval);

            if (is_null($donatur->last_reminder_send) || $today->gte($nextReminder)) {
                Mail::to($jamaah->email)->send(new PengingatDonasi($donatur, $jamaah->nama));

                $donatur->last_reminder_send = $today;
                $donatur->save();

                Log::info("Email pengingat dikirim ke {$jamaah->nama}");
            }
        }

        $this->info('Pengingat donatur tetap telah dikirim.');
    }
}
