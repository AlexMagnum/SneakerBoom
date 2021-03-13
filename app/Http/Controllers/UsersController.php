<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UsersEditRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;
use \Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select('*');
            return Datatables::of($users)
                ->addColumn('role', function ($users) {
                    $str = str_replace("[\"", "", $users->getRoleNames());
                    $str = str_replace("\"]", "", $str);
                    $role = '<span>' . $str . '</span>';
                    return $role;
                })
                ->addColumn('action', function ($users) {
                    $button = '
                        <a href="' . route('users.show', $users->id) . '" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="' . route('users.edit', $users->id) . '" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <form action="' . route('users.delete', $users->id) . '" method="POST" class="delform">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                    </form>';
                    return $button;
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }

        return view('Back.Users.usersshow');
    }

    public function create()
    {
        return view('Back.Users.usersadd');
    }

    public function store(UserAddRequest $request)
    {
        $user = new User();

        $user->name = $request->nickname;

        if (!User::where('email', $request->email)->first())
            $user->email = $request->email;
        else {
            return redirect()->back()->with('alert-abort', 'Користувач з вказаним email уже зареєстрований!');
        }

        $user->password = Hash::make($request->password);

        if ($request->role == "Звичайний користувач")
            $user->assignRole('user');
        elseif ($request->role == "Адміністратор")
            $user->assignRole('admin');
        elseif ($request->role == "Менеджер")
            $user->assignRole('manager');
        elseif ($request->role == "Редактор")
            $user->assignRole('redactor');

        if (isset($request->phone))
            $user->phone = $request->phone;
        if (isset($request->pip))
            $user->pip = $request->pip;
        if (isset($request->birthdate))
            $user->birthdate = date('Y-m-d', strtotime($request->birthdate));
        if (isset($request->oblast))
            $user->region = $request->oblast;
        if (isset($request->city))
            $user->city = $request->city;
        if (isset($request->department))
            $user->number_department = $request->department;

        $user->created_at = date(now());
        $user->updated_at = date(now());

        $user->save();
        return redirect()->route('users.view')->with('alert-success', 'Новий користувач успішно доданий до бази даних!');
    }

    public function show($id)
    {
        $user = User::find($id);

        $role = null;
        if ($user->hasRole('user'))
            $role = "Звичайний користувач";
        elseif ($user->hasRole('admin'))
            $role = "Адміністратор";
        elseif ($user->hasRole('manager'))
            $role = "Менеджер";
        elseif ($user->hasRole('redactor'))
            $role = "Редактор";

        return view('Back.Users.usersview', [
            'user' => $user,
            'role' => $role
        ]);
    }


    public function edit($id)
    {
        $user = User::find($id);

        $role = null;
        if ($user->hasRole('user'))
            $role = "Звичайний користувач";
        elseif ($user->hasRole('admin'))
            $role = "Адміністратор";
        elseif ($user->hasRole('manager'))
            $role = "Менеджер";
        elseif ($user->hasRole('redactor'))
            $role = "Редактор";

        return view('Back.Users.usersedit', [
            'user' => $user,
            'role' => $role
        ]);
    }

    public function update(UsersEditRequest $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->nickname;

        if ($user->email != $request->email) {
            if (!User::where('email', $request->email)->first()) {
                $user->email = $request->email;
            } else {
                return redirect()->back()->with('alert-abort', 'Користувач з вказаним email уже зареєстрований!');
            }

        }

        if (isset($request->password))
            $user->password = Hash::make($request->password);

        if ($request->role == "Звичайний користувач") {
            if (!$user->hasRole('user')) {
                $user->syncRoles();
                $user->assignRole('user');
            }
        } elseif ($request->role == "Адміністратор")
        {
            if (!$user->hasRole('admin')) {
                $user->syncRoles();
                $user->assignRole('admin');
            }
        } elseif ($request->role == "Менеджер")
        {
            if (!$user->hasRole('manager')) {
                $user->syncRoles();
                $user->assignRole('manager');
            }
        }elseif ($request->role == "Редактор")
        {
            if (!$user->hasRole('redactor')) {
                $user->syncRoles();
                $user->assignRole('redactor');
            }
        }

        if (isset($request->phone))
            $user->phone = $request->phone;
        if (isset($request->pip))
            $user->pip = $request->pip;
        if (isset($request->birthdate))
            $user->birthdate = date('Y-m-d', strtotime($request->birthdate));
        if (isset($request->oblast))
            $user->region = $request->oblast;
        if (isset($request->city))
            $user->city = $request->city;
        if (isset($request->department))
            $user->number_department = $request->department;

        $user->updated_at = date(now());

        $user->save();
        return redirect()->route('users.view')->with('alert-success', 'Новий користувач успішно доданий до бази даних!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->syncRoles();
        $user->delete();

        return redirect()->route('users.view')->with('alert-success', 'Користувача було успішно видалено з бази даних!');

    }
}
