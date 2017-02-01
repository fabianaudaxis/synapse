<?php
/**
 * Formulaire de création et édition d'une action.
 * 
 * @var EwbsAction $modelInstance
 * @var EwbsActionRevision $revision
 */

$state=Input::old('state', $revision ? $revision->state : EwbsActionRevision::$STATE_TODO);
$priority=Input::old('priority', $revision ? $revision->priority : EwbsActionRevision::$PRIORITY_NORMAL);
?>
@extends('site.layouts.container-fluid')
@section('title')Edition de l'action <em>{{ $modelInstance->name }}</em> @stop
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="block-flat">
			{{-- CreateEdit Form --}}
			<form class="form-horizontal" method="post" autocomplete="off" action="{{ $modelInstance->routeGetEdit() }}">
				{{-- CSRF Token --}}
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<input type="hidden" name="name" value="{{$modelInstance->name}}" /> {{-- le validator demande à ce que name soit présent --}}
				{{-- ./ csrf token --}}
				
				{{-- Description --}}
				<div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
					<label class="col-md-2 control-label" for="description">Description</label>
					<div class="col-md-10">
						<textarea class="form-control" name="description" placeholder="Description" rows="6">{{{ Input::old('description', $revision ? $revision->description : null) }}}</textarea>
						{{ $errors->first('description', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				{{-- ./ Description --}}
				
				{{-- State --}}
				<div class="form-group {{{ $errors->has('state') ? 'has-error' : '' }}}">
					<label class="col-md-2 control-label" for="state">Etat</label>
					<div class="col-md-10">
						<select class="form-control" name="state"{{($modelInstance->sub && $modelInstance->eachSub()->count()>0)?' disabled title="L\'état est automatiquement défini par les sous-actions"':''}}>
						@foreach(EwbsActionRevision::states() as $s)
							<option value="{{$s}}"{{ $s==$state ? ' selected': '' }}>{{ Lang::get( "admin/ewbsactions/messages.state.{$s}") }}</option>
						@endforeach
						</select>
						{{ $errors->first('state', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				{{-- ./ State --}}
				
				{{-- Priority --}}
				<div class="form-group {{{ $errors->has('priority') ? 'has-error' : '' }}}">
					<label class="col-md-2 control-label" for="priority">Priorité</label>
					<div class="col-md-10">
						<select class="form-control" name="priority"{{$loggedUser->can('ewbsaction_prioritize')?' ':' disabled'}}>
						@foreach(EwbsActionRevision::priorities() as $p)
							<option value="{{$p}}"{{ $p==$priority ? ' selected': '' }}>{{ Lang::get( "admin/ewbsactions/messages.priority.{$p}") }}</option>
						@endforeach
						</select>
						{{ $errors->first('priority', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				{{-- ./ Priority --}}
				
				{{-- Sub --}}
				@if($loggedUser->hasRole('admin'))
				<div class="form-group {{{ $errors->has('sub') ? 'has-error' : '' }}}">
					<label class="col-md-2 control-label" for="sub">Sous-actions autorisées</label>
					<div class="col-md-10">
						<div class="switch">
							<input type="checkbox" name="sub"{{ $errors->count()>0 ? (Input::old('sub')?' checked':'') : ($modelInstance && $modelInstance->sub ? ' checked':'') }} />
						</div>
						{{ $errors->first('sub', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				@endif
				{{-- ./ Sub --}}

				{{-- Taxonomie --}}
				<div class="form-group" {{{ $errors->has('tags') ? 'has-error' : '' }}}>
					<label class="col-md-2 control-label" form="tags">Tags</label>
					<div class="col-md-10">
						<!-- tags -->
						<?php
						// recherche de l'élément à selectionner
						$selectedTags = [];
						if ($modelInstance)
							$selectedTags = $aSelectedTags; //passée par le controlleur (voir function getManage());
						if (Input::old('tags'))
							$selectedTags = Input::old('tags');
						?>
						<select class="form-control select2" name="tags[]" id="tags" multiple>
							@foreach($aTaxonomy as $category)
								<optgroup label="{{$category->name}}">
									@foreach($category->tags as $tag)
										<option value="{{$tag->id}}"{{ in_array($tag->id, $selectedTags) ? ' selected': '' }}>{{$tag->name}}</option>
									@endforeach
								</optgroup>
							@endforeach
						</select>
						{{ $errors->first('tags', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				
				{{-- Actions --}}
				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						<a class="btn btn-cancel" href="{{ $modelInstance->routeGetView() }}">{{Lang::get('button.cancel')}}</a>
						<button type="submit" class="btn btn-primary">{{Lang::get('button.save')}}</button>
					</div>
				</div>
				{{-- ./ form actions --}}
			</form>
		</div>
	</div>
</div>
@stop