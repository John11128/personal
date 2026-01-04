<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Reportes;


class UsuariosController extends Controller
{


    public function PrimerUsuario()

    {
        User::create([

            'name'=>'John',
            'email'=>'John2005@gmail.com',
            'foto'=> '',
            'estado'=>1,
            'ultimo_login'=> now(),
            'roll'=>'Administrador',
            'password'=>Hash::make('2005'),
            'id_sistema'=>0, 

        ]);
        return response()->json(['message' => 'Usuario creado correctamente']);
    }

    

    /**
     * Display a listing of the resource.
     */

   public function index()
        {
            //
            if (Auth::user()->roll != 'Administrador') {
                    return redirect('Inicio')->with('error', 'No tienes permiso para acceder a esta sección.');
                }
                $usuarios = User::orderBy('id', 'asc')->paginate(50);
                 return view('modulos.users.usuarios.index', compact('usuarios'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //crear un nuevo usuario
                $validarEmail = request()->validate([
                    'email' => 'unique:users,email',
                ]);
                $datos = request();
                $user = User::create([
                    'name' => $datos['name'],
                    'email' => $validarEmail['email'],
                    'foto' => '',
                    'estado' => 1,
                    'ultimo_login' => now(),
                    'roll' => $datos['roll'],
                    'password' => Hash::make($datos['password']),
                    
                ]);
                 // 3. REGISTRO DEL REPORTE (Corregido y Específico a la Acción)
    Reportes::create([
        'tipo_r' => 'usuario',
        'titulo_r' => 'Usuario Creado',
        'descripcion_r' => "El usuario '{$user->name}' (ID: {$user->id}) fue creado por " . (Auth::user()->name ?? 'un proceso del sistema') . ".",
        'detalle_r' => [ // Usamos los datos del nuevo usuario
            'nuevo_usuario_id' => $user->id,
            'nombre' => $user->name,
            'email' => $user->email,
            'roll' => $user->roll,
            'creado_por_usuario' => Auth::user()->name ?? 'Desconocido',
        ],
        'usuario_id' => Auth::id(), // ID de la persona que realiza la acción
    ]);
                return redirect('Usuarios')->with('success', 'Usuario creado correctamente');
                //editar un usuario
    }
protected function authenticated(Request $request, $user)
{
    if ($user->estado == 0) {
        Auth::logout();
        return redirect('/')->withErrors(['email' => 'Tu usuario está desactivado.']);
    }
    $user->ultimo_login = now();
    $user->save();
}

       public function CambiarEstado(string $id, int $estado)
            {
                //
                User::find($id)->update(['estado' => $estado]);
                return redirect('Usuarios')->with('success', 'Estado del usuario actualizado correctamente');
            }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_usuario)
            {
                $usuario = User::find($id_usuario);
                return response()->json($usuario);
            
            }
  public function VerificarUsuario(Request $request)
            {
            $user = User::find($request->id);
            if($request->email != $user->email){
            $emailExistente = User::where('email', $request->email)->exists();
            if($emailExistente != null){
                $verificacion = false;
            }else{
                $verificacion = true;
            }
            }else{
                $verificacion = true;
            }
            return response()->json(['emailVerificacion' => $verificacion]);
            }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         if (request('')){
                    $ValidarPass = request()->validate([
                    'password' => ['string','min:3']
                ]);
                $pass = true;
                }else{
                    $pass = false;
                }
                $datos = request();
                $User = User::find($datos['id']);

                $User->name = $datos['name'];
                $User->email = $datos['email'];
                $User->roll = $datos['roll'];
                         // Solo actualiza la contraseña si viene en el request y no está vacía
        if (!empty($datos['password'])) {
            $request->validate([
                'password' => ['string', 'min:3']
            ]);
            $User->password = Hash::make($datos['password']);
        }
                $User->save();
                return redirect('Usuarios')->with('success', 'Usuario actualizado correctamente');
            }
        }