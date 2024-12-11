<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Inicia a query base
        $query = User::query();

        // Verifica se há termo de pesquisa
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        }

        if ($request->filled('role_id')) {
            $roleId = $request->input('role_id');
            $query->where('role_id', $roleId);
        }

        // Ordena e pagina os resultados
        $users = $query->orderBy('id')->paginate(5);

        // Retorna para a view
        return view('pages.users.index', ['users' => $users]);
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|integer|in:1,2,3,4'
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->back()->with('status', 'Função atualizada com sucesso!')->with('class', 'alert-success');
    }

    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('status', 'Password atualizada com sucesso!')->with('class', 'alert-success');
    }

    public function searchUser(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')->paginate(10);
        $users = User::where('email', 'like', '%' . $search . '%')->paginate(10);
        return view('pages.users.index', ['users' => $users]);
    }

    public function downloadUsersList(Request $request)
    {
        // Obter os IDs dos pagamentos
        $userIdsArray = explode(',', $request->user_ids);
        $users = User::whereIn('id', $userIdsArray)->get();

        // Cabeçalhos do Excel
        $excelArray = [];
        $excelArray[0] = [
            "ID"       => "ID",
            "Nome"     => "Nome",
            "Email"    => "Email",
            "Telefone" => "Telefone",
            "Função"   => "Função"
        ];

        // Preenchendo os dados
        $key = 1;
        foreach ($users as $user) {
            // Determinar a função com base no role_id
            $roleName = match ($user->role_id) {
                1 => 'Admin',
                2 => 'Manager',
                3 => 'Proprietário',
                4 => 'Participante',
                default => 'Desconhecido',
            };
        
            $excelArray[$key] = [
                "ID"       => $user->id,
                "Nome"     => $user->name,
                "Email"    => $user->email,
                "Telefone" => $user->phone,
                "Função"   => $roleName,
            ];
            $key++;
        }

        // Fazer o download
        return Excel::download(new UsersExport($excelArray), 'UsersList.xlsx');        
    }
}