<?php 
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotasController extends Controller
{
    // Mostrar todas las notas
    public function lista()
    {
        $notes = Note::orderBy('fecha', 'desc')->get();
        return response()->json($notes);
    }

    // Mostrar una nota específica
    public function dataId($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        return response()->json($note);
    }

    // Crear una nueva nota
    public function registrar(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'etiquetas' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $note = Note::create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'fecha' => $request->fecha,
                'etiquetas' => $request->etiquetas,
                'idUsu' => 1,
            ]);

            DB::commit(); // Confirma la transacción

        } catch (\Exception $e) {
            DB::rollBack(); // Revierte la transacción si algo falla
            
            return response()->json(Log::error($e->getMessage()), 500);
        }

        return response()->json($note, 201);
    }

    // Actualizar una nota existente
    public function actualizar(Request $request, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'etiquetas' => 'nullable|string',
        ]);

        DB::beginTransaction();
       
        try {

            $note->update($request->all());

        } catch (\Exception $e) {
            DB::rollBack(); 
            
            return response()->json(Log::error($e->getMessage()), 500);
        }


        return response()->json($request->all());
    }

    // Eliminar una nota
    public function eliminar($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $note->delete();

        return response()->json(['message' => 'Nota eliminada correctamente']);
    }
}