<?php
/**
 * Send an email job class.
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
/**
 * Sending an email process class.
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Receiver email address.
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team

     */
    protected $receiver;

    /**
     * Email message subject.
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team

     */
    protected $subject;

    /**
     * Email message body.
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team

     */
    protected $message;

    /**
     * Email header.
     *
     * @var array
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team

     */
    protected $header;

    /**
     * Create a new job instance.
     *
     * @param string  $receiver
     * @param string  $subject
     * @param string  $message
     * @param string  $header
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct($receiver, $subject, $message, $header)
    {
        $this->receiver = $receiver;
        $this->subject = $subject;
        $this->message = $message;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        mail($this->receiver, $this->subject, $this->message, $this->header);
    }
}
