<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historico;
use App\HistoricoHabitos;
use App\Http\Requests\HistoricoRequest;

class HistoricosController extends Controller
{

    public function index(){
        $historicos = Historico::all();
        return view('historicos.index', ['historicos'=>$historicos]);
    }

	public function create(){
		return view('historicos.create');
    }

    /*
    public function destroy($id){
        Historico::find($id)->delete();
        return redirect()->route('historicos');
    }
    */
    public function destroy($id){
        try {
            HistoricoHabitos::where("historico_id", $id)->delete();
            Historico::find($id)->delete();
            $ret = array(
                'status'    => 'ok',
                'msg'       => 'null'
            );
        } catch(\Illuminate\Database\QueryException $e) {
            $ret = array(
                'status'    => 'erro',
                'msg'       => $e->getMessage()
            );
        } catch (\PDOException $e) {
            $ret = array(
                'status'    => 'erro',
                'msg'       => $e->getMessage()
            );
        }
        return $ret;
    }

    public function edit($id){
        $historico = Historico::find($id);
        return view('historicos.edit', compact('historico'));
    }

    public function update(HistoricoRequest $request, $id){
        $historico = Historico::find($id)->update($request->all());
        return redirect()->route('historicos');
    }

    public function store(HistoricoRequest $request) {
        $novo_historico = $request->all();
        Historico::create($novo_historico);
        return redirect()->route('historicos');
    }

    public function createmaster() {
        return view('historicos.masterdetail');
    }

    public function masterdetail(Request $request) {
        $historico = Historico::create([
            'data' => $request->get('data'),
            'hora' => $request->get('hora')
        ]);

        $itens = $request->itens;
        foreach($itens as $key => $value) {
            HistoricoHabitos::create([
                'historico_id'  => $historico->id,
                'habito_id'     => $itens[$key]
            ]);
        }
        return redirect()->route('historicos');
    }

}
