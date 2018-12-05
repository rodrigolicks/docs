@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
			<div class="panel panel-default">
					<div class="panel-heading">Início</div>

					<div class="panel-body">
						<h2>Bem vindo ao sistema de Gestão de documentos</h2>
						<p>Para começar, selecione no menu à esquerda a opção desejada.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
