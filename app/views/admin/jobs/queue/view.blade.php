<?php
/**
 * @var Barryvdh\Queue\Models\Job $job
 */
$payload=json_decode($job->payload,true);
?>

@extends('site.layouts.container-fluid')
@section('title')<span class="text-primary">{{ManageableModel::formatId($job->id, 6)}}</span> {{$payload['job']}} @stop
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="block-flat">
			<div class="header">
				<h3></h3>
			</div>
			<div class="content">
				<h4>Queue</h4>
				<p>{{$job->queue}}</p>
				<hr/>
				
				<h4>Etat</h4>
				<p>{{$job->statustext()}}</p>
				<hr/>
				
				<h4>Méthode</h4>
				<p>{{$payload['job']}}</p>
				<hr/>
				
				<h4>Vue</h4>
				<p>{{$payload['data']['view']}}</p>
				<ul>
				@foreach($payload['data']['data'] as $key=>$value)
					<li>{{$key}} : {{print_r($value,true)}}</li>
				@endforeach
				</ul>
				<hr/>
				
				@if($job->retries)
				<h4>Essais</h4>
				<p>{{$job->retries}}</p>
				@endif
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block-flat">
			<p><span class="fa fa-calendar"></span> Créé le {{DateHelper::datetime($job->created_at)}}</p>
			@if($job->updated_at)
			<p><span class="fa fa-calendar"></span> MAJ le {{DateHelper::datetime($job->updated_at)}}</p>
			@endif
		</div>
	</div>
</div>
@if(isset($payload['error']))
	<div class="block-flat">
	<h4>Erreur</h4>
	<p class="text-danger">{{nl2br($payload['error'])}}</p>
	<hr/>
</div>
@endif
@stop