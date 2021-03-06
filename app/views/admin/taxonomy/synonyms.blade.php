@extends('site.layouts.container-fluid')
@section('title')Taxonomie - Gestion de la synonymie @stop
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="block-flat">
			<div class="header">
				<h3>Groupes de synonymes</h3>
			</div>
			<div class="content">
				<span id="nestableSaving" class="hidden"><i class="fa fa-spinner fa-spin"></i> Sauvegarde en cours</span>
				<div id="tagGroups">
					@foreach ($classified as $key => $value)
						<div class="dd well row" style="padding:10px;" data-groupid="{{$key}}">
							<ol class="dd-list">
								@foreach ($value as $tag)
									<li class="dd-item dd3-item" data-id="{{$tag->id}}">
										<div class="dd-handle dd3-handle"></div><div class="dd3-content">{{$tag->name}}</div>
									</li>
								@endforeach
							</ol>
						</div>
					@endforeach
				</div>
				<div class="row"><div class="col-md-12">
					<a id="nestableAddGroup" class="btn btn-primary"><span class="fa fa-plus"></span> Ajouter un groupe de tags</a>
				</div></div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="block-flat">
			<div class="header">
				<h3>Tags non groupés</h3>
			</div>
			<div class="content">
				<div class="dd" id="unclassifiedTags" data-groupid="NONE">
					<ol class="dd-list @if (!count($unclassified)) dd-empty @endif">
						@foreach($unclassified as $tag)
							<li class="dd-item dd3-item" data-id="{{$tag->id}}">
								<div class="dd-handle dd3-handle"></div><div class="dd3-content">{{$tag->name}}</div>
							</li>
						@endforeach
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function () {
		$('a#nestableAddGroup').click( function () {
			$('<div class="dd well row" data-groupid="-1" style="padding:10px;"><ol class="dd-list dd-empty"></ol></div>')
			.appendTo($('#tagGroups'))
			.nestable({
				maxDepth: 1,
				group: 1,
				callback: function (e) {
					nestableRefresh();
				}
			});
		});
		
		$('.dd').nestable({
			maxDepth:1,
			group:1,
			callback: function (l, e) {
				nestableRefresh(l, e);
			}
		});
		
		$("#nestableSaving").removeClass('hidden').hide();

	});

	function nestableRefresh(l, e) {
		$("#nestableSaving").show();
		var groupId = l.data('groupid');
		var ids = new Array();
		$.each(l.nestable('serialize'), function (index, value) {
			ids.push(value.id);
		});
		//console.log(groupId + " : " + ids);
		$.ajax({
			method: "POST",
			url: '{{route("taxonomyPostSynonyms")}}',
			data: { '_token': '{{csrf_token()}}', 'groupId': groupId, 'ids': ids}
		}).done(function (data) {
			//console.log(data);
			if (data.error == "undefined") {
				alert('Erreur de communication avec Synapse. Les changements n\'ont pas été sauvegardés. Veuillez réessayer plus tard.');
			}
			else {
				if (data.error == true) {
					alert('Erreur de communication avec Synapse. Les changements n\'ont pas été sauvegardés. Veuillez réessayer plus tard.');
				}
				else {
					//si on avait pas de groupId, on doit en recevoir un
					if ( data.groupId !== "undefined" ) {
						l.attr('data-groupid', data.groupId);
					}
				}
			}
		}).fail( function () {
			alert('Erreur de communication avec Synapse. Les changements n\'ont pas été sauvegardés. Veuillez réessayer plus tard.');
		}).always( function () {
			$("#nestableSaving").hide();
		});
	}
</script>
@stop


