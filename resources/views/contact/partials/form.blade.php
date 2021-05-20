<div class="form-group">
  <label for="inputName">Название задачи</label>
  <input type="text" class="form-control" id="inputName" name="name" value="{{ $contact->name ?? old('name')}}" placeholder="Введите название задачи" required>
</div>
<div class="form-group">
  <label for="inputPriority">Приоритет задачи</label>
  <select class="form-control" id="inputPriority" name="priority">
    <option value="1" {{ (($contact->priority ?? old('priority')) == "1") ? "selected" : "" }}>Приоритет 1</option>
    <option value="2" {{ (($contact->priority ?? old('priority')) == "2") ? "selected" : "" }}>Приоритет 2</option>
    <option value="3" {{ (($contact->priority ?? old('priority')) == "3") ? "selected" : "" }}>Приоритет 3</option>
  </select>
</div>
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
<hr>
<button type="submit" class="btn btn-primary">Сохранить</button>
<a class="btn btn-danger" href="{{ route('contacts.index') }}">Отмена</a>
