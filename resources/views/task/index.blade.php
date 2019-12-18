@extends('layouts.app')

@section('content')

<div class="container d-flex h-100 flex-column">
    <div class="row justify-content-center">
        <div class="col-sm-10">
        <div style="height:25px">
            <div class="task-message"></div>
        </div>
            <form class="form-task" method="post" action="{{ route('task.add') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="task"><strong>Task</strong></label>
                    <input type="text" class="form-control" placeholder="Enter your task" name="task" maxlength="255">
                </div>
                <button type="submit" class="btn btn btn-success">Add</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-10 mt-4">
            <div id="task-list" data-action="{{ route('task.list') }}"></div>
        </div>
    </div>
</div>

<div class="modal fade task-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="height:25px">
                    <div class="task-message"></div>
                </div>
                <form class="form-task" method="post" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="task"><strong>Task</strong></label>
                        <input type="text" class="form-control" placeholder="Enter your task" name="task" maxlength="255">
                    </div>
                    <button type="submit" class="btn btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
