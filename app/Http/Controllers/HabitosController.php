<?php

namespace App\Http\Controllers;

use App\Habito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HabitoRequest;
use Illuminate\Support\Facades\Input;

class HabitosController extends Controller
{
    /*
    // Listagem sem filtro
    public function index(){
        $habitos = Habito::orderBy('nome')->paginate(10);
        return view('habitos.index', ['habitos'=>$habitos]);
    }
    */

    public function index(Request $filtro) {
        $filtragem = $filtro->get('filtragem');
        if ($filtragem == null)
            $habitos = Habito::orderBy('nome')->paginate(10);
        else
            $habitos = Habito::where('nome', 'like', '%' . $filtragem .'%')
                        ->orderBy("nome")->paginate(20);
        return view('habitos.index', ['habitos' => $habitos]);
    }

	public function create(){
		return view('habitos.create');
    }

    public function destroy($id){
        try {
            Habito::find($id)->delete();
            $ret = array('status'=>'ok', 'msg'=>"null");
        } catch(\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        } catch(\PDOException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        }
        return $ret;
        //return redirect()->route('habitos');
    }

    public function edit($id){
        $habito = Habito::find($id);
        return view('habitos.edit', compact('habito'));
    }

    public function update(HabitoRequest $request, $id){
        $habito = Habito::find($id)->update($request->all());
        return redirect()->route('habitos');
    }

    /*
    // método store antigo
    public function store(HabitoRequest $request) {
        $novo_habito = $request->all();
        Habito::create($novo_habito);
        return redirect()->route('habitos');
    }
    */

    public function store(HabitoRequest $request) {
        $input = $request->all();

        if(Input::hasFile('foto')) {
            $file = Input::file('foto');
            $conteudo = file_get_contents($file);
            $habito = new Habito();
            $habito->nome = $request->get('nome');
            $habito->descricao = $request->get('descricao');
            $habito->tp_habito = $request->get('tp_habito');
            $habito->objetivo = $request->get('objetivo');
            $habito->dt_inicio_ctrl = $request->get('dt_inicio_ctrl');
            $habito->foto = $conteudo;
            $habito->save();
            \Storage::disk('public')->put($habito->id . ".jpg", $conteudo);
        } else {
            Habito::create($input);
        }
        return redirect()->route('habitos');
    }



    public function geraPdf() {
        $habitos = Habito::all();

        $view = \View::make('habitos.relatorio', ['habitos' => $habitos]);
        $html = $view -> render();
        $pdf = \PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');

        return $pdf->download('relatorio.pdf');
    }

}
