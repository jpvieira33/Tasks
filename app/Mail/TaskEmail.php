<?php

namespace App\Mail;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class TaskEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $task;
    private $user;

    private $category;

    /**
     * Create a new message instance.
     */
    public function __construct(Task $task, Authenticatable $user)
    {
        $this->task = $task;
        $this->user = $user;
        $this->category = Category::find($task->category_id);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Criada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mail.email',
            with:[
                'nome'=> $this->user->name,
                'title_task' => $this->task['title'],
                'category_title' => $this->category->title
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
           // Attachment::fromPath('D:\B7web\Laravel\tasks\public\assets\images\graph.png')
           // ->as('graph.png'),
        ];
    }
}
