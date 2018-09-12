<?php

namespace App\Jobs;

use App\Key;
use App\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendChavesNaoDevolvidasEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chave;

    protected $pessoa;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $rows = DB::table('keys_has_people')
            ->whereNull('devolucao')
            ->where('retirada', '<', date('Y-m-d 00:00:00'))
            ->get();

        foreach($rows as $value) {
            $chave = Key::find($value->key_id);
            $pessoa = Person::find($value->people_id);

            $nome = $pessoa->nome;
            $email = $pessoa->email;


            Mail::send('emails.chaves.nao-devolvida', ['key' => $chave, 'nome' => $nome, 'data' => $value->retirada], function ($m) use ($email, $nome) {
                $m->from(env('MAIL_FROM_EMAIL', 'no-reply@ifro.edu.br'), env('MAIL_FROM_NAME', 'Guarita IFRO - Ji-Paraná'));

                $m->to($email, $nome)->subject("Chave não devolvida");

            });
        }
    }
}
