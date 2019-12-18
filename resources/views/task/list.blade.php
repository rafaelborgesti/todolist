@if ( count($tasks_pending) )
<p align="center"><b>Pending tasks</b></p>
<table class="table table-dark">
    <tbody>
    @foreach ( $tasks_pending as $task_pending )
        <tr>
            <td class="align-middle" style="width: 60%">
                <div class="item-tarefa" style="word-break: break-word;">{{ $task_pending->task }}</div>
            </td>
            <td align="right">
                <a href="javascript:void();" class="btn btn-close-task" data-action="{{ route('task.close',$task_pending->task_uuid) }}">
                <i class='fas fa-check-circle' style='font-size:18px;color:white;'></i></a>
                <a href="javascript:void(0);" class="btn btn-edit-task" data-toggle="modal" data-target=".task-modal" 
                data-action="{{ route('task.edit',$task_pending->task_uuid) }}" data-task="{{ $task_pending->task }}">
                <i class="fa fa-edit" style="font-size:18px"></i></a>
                <a href="javascript:void();" class="btn btn-delete-task" data-action="{{ route('task.delete',$task_pending->task_uuid) }}">
                <i class='fas fa-trash-alt' style='font-size:18px;color:red;'></i></a>
              </td>
        </tr>
    </tbody>
    @endforeach
</table>
@endif

@if ( count($tasks_completed) )
<p align="center"><b>Completed tasks</b></p>

<table class="table table-dark">
    <tbody>
    @foreach ( $tasks_completed as $task_completed )
        <tr>
            <td class="align-middle" style="width: 85%">
                <div class="item-task" style="word-break: break-word;">{{ $task_completed->task }}</div>
            </td>
            <td align="right">
                <a href="javascript:void();" class="btn btn-delete-task" data-action="{{ route('task.delete',$task_completed->task_uuid) }}">
                <i class='fas fa-trash-alt' style='font-size:18px;color:red;'></i></a>
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
@endif

    

