<?php
/**
 * Modale de demande de confirmation de suppression d'un élément
 * 
 * @var string $url
 */
?>
<div class="modal fade noAuto colored-header danger" id="servermodal" tabindex="-1" role="dialog" aria-labelledby="servermodal-title">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="servermodal-title">Confirmer la suppression ?<span></span></h3>
			</div>
			<div class="modal-body">
				<p>Sûr et certain ? Pas de regret ?</p>
			</div>
			<div class="modal-footer">
				<form method="post" autocomplete="off" action="{{ $url }}">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('button.cancel')}}</button>
					<button type="submit" name="action" value="delete" class="btn btn-danger">{{Lang::get('button.delete')}}</button>
				</form>
			</div>
		</div>
	</div>
</div>