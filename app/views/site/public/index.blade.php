@extends('site.layouts.container')
@section('content')
<div class="row">
	<div class="col-md-12">
		<h2 class="text-center"><span class="text-primary">Synapse</span>, l'outil de pilotage des idées et projets de simplification administrative</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{{ HTML::image('images/screenshot-dashboard.jpg', 'capture ecran du dashboard', ['class' => 'img-responsive']) }}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="block-flat">
			<p>
				Cette plateforme est un outil mis à disposition des administrations et organismes d’intérêt public par e-Wallonie-Bruxelles Simplification (eWBS), afin de piloter la simplification administrative dans leur institution.<br/>
				<strong>Synapse</strong> collecte toutes les informations disponibles sur une démarche administrative et les combine au sein d’un tableau de bord.<br/>
				Cette visualisation permet d’affiner la stratégie simplif’ de façon transversale ou spécifique en fonction de vos usagers, de vos matières, de vos projets.
			</p>
			<p>
				En travaillant sur les expertises proposées par eWBS telles que la réalisation de calculs de charges administratives, l’analyse des pièces demandées aux usagers,  l’état des lieux des formulaires, vous serez en mesure de cibler les problèmes et les opportunités, prioriser vos projets et valoriser le travail réalisé par vos agents.
			</p>
			<p>
				Destiné à s’enrichir de nouveaux outils et expertises en ligne, <strong>Synapse</strong> offre aux administrations et organismes d’intérêt public un véritable support à la prise de décision.
			</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3 class="text-center">Principales fonctionnalités</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="block-flat">
			<div class="header">
				<span class="pull-right"><i class="fa fa-2x fa-lightbulb-o color-primary"></i></span>
				<h5>Gestion des projets de simplif'</h5>
			</div>
			<div class="content">
				Collecte et priorisation des projets de simplification adminsitrative.
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block-flat">
			<div class="header">
				<span class="pull-right"><i class="fa fa-2x fa-briefcase color-success"></i></span>
				<h5>Pilotage des démarches</h5>
			</div>
			<div class="content">
				Suivi et reporting du catalogue des démarches administratives.
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block-flat">
			<div class="header">
				<span class="pull-right"><i class="fa fa-2x fa-calculator color-danger"></i></span>
				<h5>Gains de charge</h5>
			</div>
			<div class="content">
				Analyse et calculs des gains de charges grâce à la méthode SCM Light.
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block-flat">
			<div class="header">
				<span class="pull-right"><i class="fa fa-2x fa-magic"></i></span>
				<h5>Suivi des actions</h5>
			</div>
			<div class="content">
				Gestion du travail day-to-day des équipes de eWBS.
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block-flat">
			<div class="header">
				<span class="pull-right"><i class="fa fa-2x fa-wpforms"></i></span>
				<h5>Formulaires électroniques</h5>
			</div>
			<div class="content">
				Inventaire des formulaires électroniques et apport d'informations.
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block-flat">
			<div class="header">
				<span class="pull-right"><i class="fa fa-2x fa-gears"></i></span>
				<h5>Reporting</h5>
			</div>
			<div class="content">
				Automatisation du reporting et des relevés auprès des comités de direction.
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3 class="text-center">Vous avez dit <em>logiciel libre</em>?</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="block-flat">
			<div class="content no-padding text-center">
				<a href="http://www.ensemblesimplifions.be" target="_blank">
					{{ HTML::image('images/logo-ewbs.png', 'logo ewbs') }}
					<br/><br/>
					Par e-Wallonie-Bruxelles Simplification
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block-flat">
			<div class="content no-padding text-center">
				<a href="https://www.gnu.org/licenses/quick-guide-gplv3.html" target="_blank">
					{{ HTML::image('images/logo-gplv3.png', 'logo gplv3') }}
					<br/><br/>
					Distribué sous licence GNU/GPLv3
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="block-flat">
			<div class="content no-padding text-center">
				<a href="https://github.com/ewbs/synapse" target="_blank">
					{{ HTML::image('images/logo-github.png', 'logo githb') }}
					<br/><br/>
					Forkez-nous sur github!
				</a>
			</div>
		</div>
	</div>
</div>
@stop