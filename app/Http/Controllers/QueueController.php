<?php

namespace App\Http\Controllers;

use App\Http\Requests\Queue\CreateRequest;
use App\Models\Queue;

use App\Http\Requests;
use Area;
use Auth;

class QueueController extends Controller
{
    public function __construct()
    {
        Area::is('queues');
    }

    public function getCreate()
    {
        return view('queue.create');
    }

    public function postCreate(CreateRequest $request)
    {
        $fields = $request->only('name', 'delay');

        $queue = Queue::create($fields);

        return redirect()->route('queue', [$queue]);
    }

    public function getEdit(Queue $queue)
    {
        return view('queue.edit', compact('queue'));
    }

    public function postEdit(CreateRequest $request, Queue $queue)
    {
        $fields = $request->only('name', 'delay');
        $queue->update($fields);

        return redirect()->route('queue', [$queue]);
    }

    public function getDelete(Queue $queue)
    {
        return view('queue.delete', compact('queue'));
    }

    public function postDelete(Queue $queue)
    {
        $queue->delete();

        return redirect('/');
    }

    public function index()
    {
        $queues = Auth::user()->queues()->paginate(20);

        return view('queue.index', compact('queues'));
    }

    public function view(Queue $queue)
    {
        dd($queue);
    }
}
