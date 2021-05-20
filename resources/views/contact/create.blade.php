@extends('layouts.app')

@section('content')

<div class="card">
  <h3 class="card-header">
    Добавить задачу
  </h3>

  <div class="card-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            @component('components.error', [
                'message' => $error,
            ])

            @endcomponent
        @endforeach
    @endif

    <form action="{{ route('tasks.store') }}" method="post">
      @csrf

      @include('contacts.partials.form')
    </form>
  </div>
</div>

@endsection
