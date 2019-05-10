<?php
/**
 * 2007-2019 PrestaShop.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
namespace PrestaShop\Module\FacetedSearch\Adapter;

interface InterfaceAdapter
{
    /**
     * Set order by field
     *
     * @param string $fieldName
     *
     * @return self
     */
    public function setOrderField($fieldName);

    /**
     * Set the order by direction for the given field
     *
     * @param string $direction
     *
     * @return self
     */
    public function setOrderDirection($direction);

    /**
     * Set the limit and offset associated with the current search
     *
     * @param int|null $limit
     * @param int $offset
     *
     * @return self
     */
    public function setLimit($limit, $offset = 0);

    /**
     * Execute the search
     *
     * @return mixed
     */
    public function execute();

    /**
     * Get the current query
     *
     * @return string
     */
    public function getQuery();

    /**
     * Get the min & max value of the field filedName associated with the current search
     *
     * @param string $fieldName
     *
     * @return mixed
     */
    public function getMinMaxValue($fieldName);

    /**
     * Get the min & max value of the price associated with the current search
     *
     * @return array
     */
    public function getMinMaxPriceValue();

    /**
     * Return all the filters associated with the current search
     *
     * @return mixed
     */
    public function getFilters();

    /**
     * Return all the operations filters associated with the current search
     *
     * @return mixed
     */
    public function getOperationsFilters();

    /**
     * Return the number of results associated for the current search
     *
     * @return int
     */
    public function count();

    /**
     * Move the current search into the "initialPopulation"
     * This initialPopulation will be used to generate the first derived table 'FROM (SELECT ...)' in the final query
     * e.g. : SELECT ... FROM (initialPopulation) p JOIN ....
     */
    public function useFiltersAsInitialPopulation();

    /**
     * Create a new SearchAdapter, keeping the initialPopulation of the current Search
     *
     * @param string $resetFilter reset this filter inside the initialPopulation
     * @param bool $skipInitialPopulation if enable, do not copy the initialPopulation filter
     *
     * @return InterfaceAdapter
     */
    public function getFilteredSearchAdapter($resetFilter = null, $skipInitialPopulation = false);

    /**
     * Add a new filter with filterName, operator & values to the current search
     * If several values are provided with the = operator, it's converted automatically to a IN () in the final query
     *
     * @param string $filterName
     * @param array $values
     * @param string $operator
     *
     * @return self
     */
    public function addFilter($filterName, $values, $operator = '=');

    /**
     * Add a stack of operations with filterName. Operations must contains filterName, values and to the current search
     *
     * @param string $filterName
     * @param array $operations
     *
     * @return self
     */
    public function addOperationsFilter($filterName, array $operations);

    /**
     * Add fieldName in the current search result
     *
     * @param string $fieldName
     *
     * @return self
     */
    public function addSelectField($fieldName);

    /**
     * Returns the number of distinct products, group by fieldName values
     *
     * @param string $fieldName
     *
     * @return mixed
     */
    public function valueCount($fieldName);

    /**
     * Reset the operations filters
     *
     * @return self
     */
    public function resetOperationsFilters();

    /**
     * Reset the filter for the given filterName
     *
     * @param string $filterName
     *
     * @return mixed
     */
    public function resetFilter($filterName);

    /**
     * Return the filter associated with filterName
     *
     * @param string $filterName
     *
     * @return mixed
     */
    public function getFilter($filterName);

    /**
     * Set the filterName to the given array value
     *
     * @param string $filterName
     * @param mixed $value
     *
     * @return mixed
     */
    public function setFilter($filterName, $value);

    /**
     * Return the current initialPopulation
     *
     * @return self
     */
    public function getInitialPopulation();

    /**
     * Return all the filters / groupFields / selectFields
     *
     * @return self
     */
    public function resetAll();

    /**
     * Copy all the filters & operationsFilters from facetedSearch to the current search
     *
     * @param InterfaceAdapter $facetedSearch
     */
    public function copyFilters(InterfaceAdapter $facetedSearch);

    /**
     * Set all the select fields
     *
     * @param array $selectFields
     *
     * @return self
     */
    public function setSelectFields($selectFields);

    /**
     * Reset all the select fields
     *
     * @return self
     */
    public function resetSelectField();

    /**
     * Add a group by field
     *
     * @param string $groupField
     *
     * @return self
     */
    public function addGroupBy($groupField);

    /**
     * Set the group by fields
     *
     * @param array $groupFields
     *
     * @return self
     */
    public function setGroupFields($groupFields);

    /**
     * Reset the group by conditions
     *
     * @return self
     */
    public function resetGroupBy();
}