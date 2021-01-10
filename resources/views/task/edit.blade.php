@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("task.index") }}">Задачи</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
        </ol>
    </nav>
    <div class="form">
        <form id="form-update-task" method="POST" action="javascript:updateTask();">
            @method('PUT')
            <div class="form-group row">
                <label for="inputTitle" class="col-sm-2 col-form-label">Заголовок</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTitle" placeholder="Заголовок" name="title" value="{{ $task->title }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputDescritpion" class="col-sm-2 col-form-label">Описание</label>
                <div class="col-sm-10">
                    <textarea rows="10" cols="45" class="form-control" placeholder="Описание" name="description">{{ $task->description }}</textarea>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Приоритет</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="priority" id="priorityLow" value="1"
                                @if ($task->priority_id === 1)
                                   checked
                                @endif
                            >
                            <label class="form-check-label" for="priorityLow">
                                Низкий
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="priority" id="priorityMiddle" value="2"
                                @if ($task->priority_id === 2)
                                   checked
                                @endif
                            >
                            <label class="form-check-label" for="priorityMiddle">
                                Средний
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="priority" id="priorityHigh" value="3"
                               @if ($task->priority_id === 3)
                                   checked
                                @endif
                            >
                            <label class="form-check-label" for="priorityHigh">
                                Высокий
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <label for="inputExpiration" class="col-sm-2 col-form-label">Время завершения</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="inputExpiration" name="expiration_date" value="{{ $task->expiration_date }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Статус</div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="2">
                        <label class="form-check-label" for="status">
                            Задача выполнена
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
            <div id="result"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function updateTask() {
        $.ajax({
            data: $('#form-update-task').serialize(),
            url: '{{ route("task.update", ['task' => $task->id]) }}',
            type: "PUT",
            dataType: 'json',
            success: function (data) {
                let resultDiv = document.getElementById('result');
                if (data.status === false) {
                    resultDiv.innerHTML = '<div class="alert alert-danger">' + data.error + '</div>';
                } else {
                    document.location.href = '{{ route("task.index") }}';
                }
            },
            error: function () {
                let resultDiv = document.getElementById('result');
                resultDiv.innerHTML = '<div class="alert alert-danger">Неверные данные</div>';
            }
        });
    }
</script>
@endsection
