<?php
class PublicSiteController extends BaseController {
	
	protected function routeGetIndex() { return route('getIndex'); }
	
	/**
	 *
	 * {@inheritDoc}
	 * @see BaseController::getSection()
	 */
	protected function getSection(){
		return 'contact';
	}
	
	/**
	 * Affiche la page d'accueil
	 *
	 * @return View
	 */
	public function getIndex() {
		// Show the page
		return View::make ( 'site/public/index' );
	}
	
	/**
	 * Affiche la page de contact
	 *
	 * @return View
	 */
	public function getContact() {
		// Show the page
		return View::make ( 'site/public/contact' );
	}


}
