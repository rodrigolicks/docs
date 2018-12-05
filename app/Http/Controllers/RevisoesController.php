<?php

namespace App\Http\Controllers;

use App\Revisao;
use App\Documento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RevisaoRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class RevisoesController extends Controller
{

    public function getDoc($id) {
        $filename = Revisao::find($id)->arquivo_id;
        $contents = collect(Storage::cloud()->listContents('/', false));
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first();
    
        $rawData = Storage::cloud()->get($file['path']);
    
        return response($rawData, 200)
            ->header('ContentType', $file['mimetype'])
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }

    public function index(Request $filtro) {
        $filtragem = $filtro->get('filtragem');
        if ($filtragem == null)
            $revisoes = Revisao::orderBy('nome')->paginate(10);
        else
            $revisoes = Revisao::where('nome', 'like', '%' . $filtragem .'%')
                        ->orderBy("nome")->paginate(20);
        return view('revisoes.index', ['revisoes' => $revisoes]);
    }

	public function create($documento_id = null){
        if ($documento_id == null) {
            return view('revisoes.create', ['documento' => null]);
        }
        else {
            $documento = Documento::find($documento_id);
            return view('revisoes.create', ['documento' => $documento]);            
        }
		
    }

    public function destroy($id){
        $documento_id = Revisao::find($id)->documento_id;        
        try {
            if (Revisao::where('documento_id', $documento_id)->count() > 1) {
                Revisao::where("revisao_id", $id)->delete();
                Documento::find($id)->delete();
                $ret = array(
                    'status'    => 'ok',
                    'msg'       => 'null'
                );    
            } else {
                $ret = array(
                    'status'    => 'erro',
                    'msg'       => 'Revisão principal não pode ser apagada.'
                );
            }

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
        $revisao = Revisao::find($id);
        return view('revisoes.edit', compact('revisao'));
    }

    public function update(RevisaoRequest $request, $id){

        $revisao = $request->all();

        if(Input::hasFile('documento_upload')) {
            die();
            
            $contents = collect(Storage::cloud()->listContents($dir, $recursive));

            $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first();
            
            Storage::cloud()->delete($file['path']);

            $extensao = $request->file('documento_upload')->extension();
            $file = Input::file('documento_upload');
            $filecontents = file_get_contents($file);
            $filename = $revisao->documento->categoria->nome . ' - ' . $revisao->documento->nome . ' (Rev ' . $revisao->numero . ' - ' . $revisao->nome . ').' . $extensao;            
            $revisao->arquivo_id = $filename;
            Storage::cloud()->put($filename, $filecontents);
        }

        $revisao = Revisao::find($id)->update($revisao);
        return redirect()->route('revisoes');
    }

    public function store(RevisaoRequest $request) {
        $revisao = $request->all();
        
        if(Input::hasFile('documento_upload')) {
            $extensao = $request->file('documento_upload')->extension();
            $file = Input::file('documento_upload');
            $filecontents = file_get_contents($file);
            $filename = $revisao->documento->categoria->nome . ' - ' . $revisao->documento->nome . ' (Rev ' . $revisao->numero . ' - ' . $revisao->nome . ').' . $extensao;            
            $revisao->arquivo_id = $filename;            
            Storage::cloud()->put($filename, $filecontents);
        }
                
        Revisao::create($revisao);
        return redirect()->route('documentos');
    }

}
