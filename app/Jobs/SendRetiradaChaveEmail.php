<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendRetiradaChaveEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chave;

    protected $pessoa;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pessoa, $chave)
    {
        $this->pessoa = $pessoa;
        $this->chave = $chave;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $nome = $this->pessoa->nome;
        $email = $this->pessoa->email;

        Mail::send('emails.chaves.retirada', ['key' => $this->chave, 'nome' => $nome], function ($m) use ($email, $nome) {
            $m->from(env('MAIL_FROM_EMAIL', 'no-reply@ifro.edu.br'), env('MAIL_FROM_NAME', 'Guarita IFRO - Ji-Paraná'));

            $m->to($email, $nome)->subject("Retirada de Chave");

        });
    }
}
