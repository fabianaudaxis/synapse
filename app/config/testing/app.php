<?php
return array (
		
		'debug' => true,
		'url' => 'https://synapse.local/',
		'locale' => 'fr',
		'timezone' => 'Europe/Brussels',
		'key' => 'jWSewz3Pfx1lLkrXAgFeCfDdsF4bZ8fd',
		'providers' => append_config ( array(
				/* uniquement en dev : commentez en prod & staging ! */
				'Way\Generators\GeneratorsServiceProvider', // Generators
				'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
				'Barryvdh\Debugbar\ServiceProvider',
		) // IDE Helpers
 ),

		
		'nostra'=>[
			'mail'=>'mgrenson@defimedia.be'
		],
)
;

