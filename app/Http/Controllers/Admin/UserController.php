<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Просмотр списка ресурсов
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // текущий авторизованный пользователь
        $user = Auth::user();

        // проверка прав пользователя
        if ($user->can('viewAny', User::class)) {
            // вывод данных
            $items = User::paginate(7);
            return view('admin.users.index', compact('items'));
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('home')
                    ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Вызов формы создания ресурса
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // текущий авторизованный пользователь
        $user = Auth::user();

        // проверка прав пользователя
        if ($user->can('create', User::class)) {
            // вывод формы для создания пользователя
            return view('admin.users.create');
        } else {
            // запрет действия с выводом сообщения об ошибке доступа
            return redirect()->route('admin.users.index')
                    ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Сохранение нового ресурса
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // User::create($request->all());
        // не подходит, так как надо создать хеш пароля
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        // сохраняем запись
        $user->save;

        return redirect()->route('admin.users.index');
    }

    /**
     * Просмотр одного ресурса
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // текущий авторизованный пользователь
        $user = Auth::user();

        $item = User::findOrFail($id);

        if ($user->can('view', $item)) {
            return view('admin.users.show', compact('item'));
        } else {
            return redirect()->route('admin.users.index')
                    ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Вызов формы редактирования ресурса
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // текущий авторизованный пользователь
        $user = Auth::user();

        $item = User::findOrFail($id);

        if ($user->can('update', $item)) {
            return view('admin.users.edit', compact('item'));
        } else {
            return redirect()->route('admin.users.index')
                    ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }

    /**
     * Обновление данных ресурса
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);

        $item->name = $request['name'];
        $item->email = $request['email'];
        $item->role = $request['role'];
        if ($request['password'] == null) {
            $item->password = bcrypt($request['password']);
        }
        $item->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Удаление ресурса
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // текущий авторизованный пользователь
        $user = Auth::user();

        $item = User::findOrFail($id);

        if ($user->can('delete', $item)) {
            $item->delete();
            return redirect()->route('admin.users.index');
        } else {
            return redirect()->route('admin.users.index')
                    ->withErrors(['msg' => 'Ошибка доступа']);
        }
    }
}
