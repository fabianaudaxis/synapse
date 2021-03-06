<?php

use Illuminate\Database\Eloquent\Builder;

/**
 * Class TraitFilterable
 * Trait pour implémenter le filtrage des éléments selons les filtres définis par l'utilisateur
 * Les classes utilisant ce trait DOIVENT implémenter les scopes de filtrages nécessaires (défini ici en abstract)
 */

	trait TraitFilterable {

		/**
		 * 
		 * @return Builder
		 */
		public static function filtered() {

			/*
			 * Pour économiser les requetes, on sauve en session user
			 * (ces variables de sessions seront détruites si le user change ses filtres)
			 */


			// filtrage par administration
			if ( ! Auth::user()->sessionGet('filteredAdministrationIds') ) {
				$filteredAdministrationIds = Auth::user()->filtersAdministration->lists('administration_id');
				Auth::user()->sessionSet('filteredAdministrationIds', $filteredAdministrationIds);
			} else {
				$filteredAdministrationIds = Auth::user()->sessionGet('filteredAdministrationIds');
			}

			// #desactivatedtags
			// filtrage par tags
			// la méthode getSynonyms retournera les synonymes, mais il faut aussi include dans le scope les tags de base ...
			/*if ( ! Auth::user()->sessionGet('filteredTagsIds') ) {
				$userTags = TaxonomyTag::findMany(Auth::user()->filtersTag->lists('taxonomy_tag_id')); // on recherche les tags de l'utilisateur
				$filteredTagsIds =
					array_merge( // ... et on merge
						TaxonomyTag::getSynonyms($userTags)->lists('id'), // ... les synonymes de ces tags
						$userTags->lists('id') // ... et les tags eux mêmes
					);
				Auth::user()->sessionSet('filteredTagsIds', $filteredTagsIds);
			} else {
				$filteredTagsIds = Auth::user()->sessionGet('filteredTagsIds');
			}*/


			// filtrage par publics cibles
			if ( ! Auth::user()->sessionGet('filteredPublicsIds') ) {
				$filteredPublicsIds = Auth::user()->filtersPublic->lists('nostra_public_id');
				Auth::user()->sessionSet('filteredPublicsIds', $filteredPublicsIds);
			} else {
				$filteredPublicsIds = Auth::user()->sessionGet('filteredPublicsIds');
			}
			
			// filtrage par expertises
			if ( ! Auth::user()->sessionGet('filteredExpertisesIds') ) {
				$filteredExpertisesIds = Auth::user()->filtersExpertise->lists('expertise_id');
				Auth::user()->sessionSet('filteredExpertisesIds', $filteredExpertisesIds);
			} else {
				$filteredExpertisesIds = Auth::user()->sessionGet('filteredExpertisesIds');
			}
			
			$queryBuilderObject = static
			::administrationsIds($filteredAdministrationIds)
			// #desactivatedtags
			// ->taxonomyTagsIds($filteredTagsIds)
			->nostraPublicsIds($filteredPublicsIds)
			->expertisesIds($filteredExpertisesIds); //appel aux scopes
			
			return $queryBuilderObject;
		}
		
		/**
		 * Filtre les données sur base du filtre utilisateur par administrations
		 * 
		 * @param Builder $query
		 * @param array $ids
		 * @return Builder
		 */
		abstract public function scopeAdministrationsIds(Builder $query, array $ids);
		
		/**
		 * Filtre les données sur base du filtre utilisateur par expertises
		 * 
		 * @param Builder $query
		 * @param array $ids
		 * @return Builder
		 */
		abstract public function scopeExpertisesIds(Builder $query, array $ids);
		
		/**
		 * Filtre les données sur base du filtre utilisateur par publics-cibles
		 * 
		 * @param Builder $query
		 * @param array $ids
		 * @return Builder
		 */
		abstract public function scopeNostraPublicsIds(Builder $query, array $ids);
		
		/**
		 * Filtre les données sur base du filtre utilisateur par tags
		 * 
		 * @param Builder $query
		 * @param array $ids
		 * @return Builder
		 */
		abstract public function scopeTaxonomyTagsIds(Builder $query, array $ids);
	}