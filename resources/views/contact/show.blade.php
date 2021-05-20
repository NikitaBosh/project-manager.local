@extends('layouts.app')

@section('content')

<div class="card">
  <h3 class="card-header">
    Детали задачи
  </h3>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><strong>Задача:</strong> {{ $contact->name }}</li>
    <li class="list-group-item"><strong>Приоритет:</strong> {{ $contact->priority }}</li>
    <li class="list-group-item"><strong>Дата создания:</strong> {{ $contact->created_at }}</li>
    <li class="list-group-item"><strong>Дата редактирования:</strong> {{ $contact->updated_at }}</li>
  </ul>
  <div class="card-body">
      <a class="btn btn-secondary" href="{{ route('contacts.edit', $contact->id) }}">
        Редактировать
      </a>
      <a class="btn btn-danger" href="{{ route('contacts.index') }}">
        Отмена
      </a>
      <form action="{{ route('contacts.destroy', $contact->id) }}" method="post" class="float-right">
              @csrf
              @method('delete')
              <button class="btn btn-danger" type="submit">Удалить</a>
            </form>
  </div>
</div>

@endsection
