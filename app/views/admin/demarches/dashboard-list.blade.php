@extends('site.layouts.container-fluid')
@section('title')Mes démarches @stop
@section('content')
@include('site.layouts.userdashboard-menu')

<div class="row">
	<div class="col-md-12">
		<div class="block-flat">
			<div class="header">
				<div class="pull-right"><a id="demarcheExport" href="javascript:void(0);" class="btn btn-small btn-default"><i class="glyphicon glyphicon-download"></i> Exporter au format XLS</a></div>
				<div class="pull-right"><a href="{{ route('damusGetRequestCreateDemarche') }}" class="btn btn-small btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Demander l'ajout d'une démarche dans NOSTRA</a></div>
				<h3>Mes démarches</h3>
			</div>
			<div class="content">
				<h4>Filtrer :</h4>
				<form id="dashboardDemarches_form" class="form-inline" data-dontobserve="1">
					<div class="row no-padding no-margin">
						<div class="col-md-6">
							<div class="row no-padding no-margin">
								<div class="col-md-12">
									<div class="form-group">
										<div class="checkbox">
											<label>
												<input type="checkbox" class="icheck" id="dashboardDemarches_onlyDocumented" {{Auth::user()->sessionGet('dashboardDemarches_onlyDocumented') ? 'checked="checked"':''}} /> Uniquement les démarches documentées
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row no-padding no-margin">
								<div class="col-md-12">
									<div class="form-group">
										<div class="checkbox">
											<label>
												<input type="checkbox" class="icheck" id="dashboardDemarches_onlyWithActions" {{Auth::user()->sessionGet('dashboardDemarches_onlyWithActions') ? 'checked="checked"':''}} /> Uniquement les démarches avec actions en cours
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row no-padding no-margin">
								<div class="col-md-12">
									<div class="form-group">
										Avec au moins
										<input class="form-control" style="width:4em;" type="text" id="dashboardDemarches_minPieces" value="{{Auth::user()->sessionGet('dashboardDemarches_minPieces') ? Auth::user()->sessionGet('dashboardDemarches_minPieces'):'0'}}" />
										pièces et
										<input class="form-control" style="width:4em;" type="text" id="dashboardDemarches_minTasks" value="{{Auth::user()->sessionGet('dashboardDemarches_minTasks') ? Auth::user()->sessionGet('dashboardDemarches_minTasks'):'0'}}" />
										tâches et
										<input class="form-control" style="width:4em;" type="text" id="dashboardDemarches_minForms" value="{{Auth::user()->sessionGet('dashboardDemarches_minForms') ? Auth::user()->sessionGet('dashboardDemarches_minForms'):'0'}}" />
										formulaires
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<hr/>
				<div class="table-responsive">
					<table id="datatable" class="table table-hover">
						<thead>
						<tr>
							<th class="col-md-1">#</th>
							<th>Nom</th>
							<th>Volume</th>
							<th>P/T/F</th>
							<th>Public(s) Cible(s)</th>
							<th>Administrations</th>
							<th>Actions</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<span class="fa fa-info-circle"></span> Votre liste de démarches est filtrée sur : {{$txtUserFiltersAdministration}}
	</div>
</div>


{{-- ce fomulaire invisible sert à l'export des démarches (la page d'export est appelée en POST --}}
<form class="hidden" id="formExportDemarches" method="post" action="{{route('demarchesPostExport')}}" target="_blank">
	<input type="hidden" id="_token" name="_token" value="{{{ csrf_token() }}}"/>
	<input type="hidden" id="demarches_ids" name="demarches_ids" value=""/>
</form>
@stop


@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {

		function getAjaxUrl() {
			//déterminer l'appel ajax sur base des paramètres du formulaire
			var ajaxUrl = "{{ $model->routeGetFilteredData() }}?";

			// documentées ?
			if ($("#dashboardDemarches_onlyDocumented").is(":checked")) {
				ajaxUrl += "&onlyDocumented=1";
			}

			// avec actions ?
			if ($("#dashboardDemarches_onlyWithActions").is(":checked")) {
				ajaxUrl += "&onlyWithActions=1";
			}

			// nombre de pièces minimum ?
			var minPieces = $("#dashboardDemarches_minPieces").val();
			if ( Math.floor(minPieces) == minPieces && $.isNumeric(minPieces) ) { //est ce un entier ?
				if (minPieces > 0) {
					ajaxUrl += "&minPieces=" + minPieces;
				}
			}

			// nombre de tâches minimum ?
			var minTasks = $("#dashboardDemarches_minTasks").val();
			if ( Math.floor(minTasks) == minTasks && $.isNumeric(minTasks) ) { //est ce un entier ?
				if (minTasks > 0) {
					ajaxUrl += "&minTasks=" + minTasks;
				}
			}

			// nombre de formulaires minimum ?
			var minForms = $("#dashboardDemarches_minForms").val();
			if ( Math.floor(minForms) == minForms&& $.isNumeric(minForms) ) { //est ce un entier ?
				if (minForms> 0) {
					ajaxUrl += "&minForms=" + minForms;
				}
			}
			return ajaxUrl;
		}

		$("input.icheck").on('ifChanged', function(event) { $(event.target).trigger('change'); }) //les checkboxes avec iCheck ne propage pas l'événement change, au profit d'un événement "ifchanged". On l'intercepte donc et on repropage le change

		$("form#dashboardDemarches_form input").change( function () {
			$tableDemarches.fnReloadAjax(getAjaxUrl());
		});

		var $tableDemarches = $('#datatable').dataTable( {
			"aoColumnDefs": [
				{ 'bSortable'  : false, 'aTargets': [6] },
				{ 'bSearchable': false, 'aTargets': [6] },
				{ 'bVisible': false, 'aTargets': [7] }
			],
			"aaSorting" : [[0, "desc"]],
			"sAjaxSource": getAjaxUrl(),
		});

		/*
		 * Gestion de l'export
		 */
		$("#demarcheExport").click( function () {
			var ids = $tableDemarches.fnGetColumnData(7);
			$("input#demarches_ids").val(ids);
			$("form#formExportDemarches").submit();
		});
	});
</script>
@stop