<?php

namespace App\Jobs;

use App\Mail\TaskEmail;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TaskSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $task;
    private $user;

    /**
     * Create a new job instance.
     */
    public function __construct(Task $task, Authenticatable $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $taskMail = new TaskEmail($this->task, $this->user);
        Mail::to('jpvieira271@gmail.com')->send($taskMail);
    }
}
