<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\Revisao;
use App\Http\Requests\DocumentoRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{

    public function index(){
        $documentos = Documento::all();
        return view('documentos.index', ['documentos'=>$documentos]);
    }

	public function create(){
		return view('documentos.create');
    }

    public function destroy($id){
        try {
            Revisao::where("documento_id", $id)->delete();
            Documento::find($id)->delete();
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

        $documento = Documento::find($id);
        return view('documentos.edit', compact('documento'));
    }

    public function update(DocumentoRequest $request, $id){
        $documento = Documento::find($id)->update($request->all());
        return redirect()->route('documentos');
    }

    public function store(DocumentoRequest $request) {
        
        $documento = Documento::create($request->all());
        $revisao = new Revisao();
        $revisao->nome = 'Inicial';
        $revisao->descricao = 'Revisão inicial do documento. Este é o documento base.';
        $revisao->numero = 1;
        $revisao->documento_id = $documento->id;

        if(Input::hasFile('documento_upload')) {
            $extensao = $request->file('documento_upload')->extension();
            $file = Input::file('documento_upload');
            $filecontents = file_get_contents($file);
            $filename = $documento->categoria->nome . ' - ' . $documento->nome . ' (Rev ' . $revisao->numero . ' - ' . $revisao->nome . ').' . $extensao;            
            $revisao->arquivo_id = $filename;
        }

        $revisao->save();
        Storage::cloud()->put($filename, $filecontents);

        return redirect()->route('documentos');
    }
}
