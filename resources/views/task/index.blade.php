@extends('layouts.app')

@section('content')
<div class="container">
    <div class="new-task row mt-3 mb-3">
        <a href='{{ route("task.create") }}' type="button" class="btn btn-outline-primary" role="button">
            <i class="fa fa-plus mr-2"></i> Создать задачу
        </a>
    </div>
    @foreach ($tasks as $task)
        <div class="task-item row priority-{{ $task->priority->name }} status-{{ $task->status->name }} mt-2" data-href="{{ route("task.edit", $task->id) }}">
            <div class="task-title col-sm-7 p-2">{{ $task->title }}</div>
            <div class="task-reminder col-sm-2 p-2">{{ $task->reminder }}</div>
            <div class="task-expiration-date col-sm-2 p-2">{{ $task->expiration_date }}</div>
            <div class="task-actions col-sm-1 p-2">
                <div class="text-white float-sm-right"><i class="fa fa-bars"></i></div>
            </div>
        </div>
    @endforeach
</div>
<script>
    $( document ).ready(function() {
        $( ".task-item" ).click(function() {
            document.location.href = this.dataset.href;
        });
    });
</script>
<style>
    .task-item {
        border: 2px solid #17a2b8;
        border-radius: 4px;
    }
    .task-item:hover {
        opacity: 0.8;
        cursor: pointer;
    }
    .priority-high {
        background-color: #dc3545;
        color: #fff;
    }
    .priority-medium {
        background-color: #ffc107;
        color: #343a40;
    }
    .priority-low {
        background-color: #17a2b8;
        color: #fff;
    }
</style>
@endsection
