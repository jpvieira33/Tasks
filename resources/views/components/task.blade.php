<div class="task {{$data['is_done'] ? 'task_done' : 'task_pending'}}">
    <div class="title">
       <input type="checkbox" name="is_done" data-id="{{$data['id']}}" onchange="taskUpdate(this)"
        @if ($data['is_done'])
            checked
        @endif
       />
       <div class="task-title">{{$data['title'] ?? ''}}</div>
    </div>
    <div class="priority">
      <div class="sphere" data-color="{{$data['category']->color}}"></div>
     <div>{{$data['category']->title ?? ''}}</div>
    </div>
    <div class="actions">
        <a href="{{route('task.edit', ['id' => $data['id']])}}"><img src="/assets/images/icon-edit.png" alt=""></a>
        <a href="{{route('task.delete',  ['id' => $data['id']])}}"><img src="/assets/images/icon-delete.png" alt=""></a>
    </div>
</div>



