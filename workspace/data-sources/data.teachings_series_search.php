<?php

	require_once(TOOLKIT . '/class.datasource.php');

	Class datasourceteachings_series_search extends SectionDatasource {

		public $dsParamROOTELEMENT = 'teachings-series-search';
		public $dsParamORDER = 'desc';
		public $dsParamPAGINATERESULTS = 'no';
		public $dsParamLIMIT = '20';
		public $dsParamSTARTPAGE = '1';
		public $dsParamREDIRECTONEMPTY = 'no';
		public $dsParamSORT = 'system:id';
		public $dsParamASSOCIATEDENTRYCOUNTS = 'yes';
		public $dsParamCACHE = '0';
		

		public $dsParamFILTERS = array(
				'233' => 'no',
				'id' => '{$ds-search}',
		);
		

		public $dsParamINCLUDEDELEMENTS = array(
				'title: formatted',
				'description',
				'teachings: title: formatted'
		);
		

		public function __construct($env=NULL, $process_params=true) {
			parent::__construct($env, $process_params);
			$this->_dependencies = array('$ds-search');
		}

		public function about() {
			return array(
				'name' => 'Teachings: Series: Search',
				'author' => array(
					'name' => 'Jonathan Simcoe',
					'website' => 'http://atheycreek',
					'email' => 'jdsimcoe@gmail.com'),
				'version' => 'Symphony 2.3.2',
				'release-date' => '2013-06-27T21:11:48+00:00'
			);
		}

		public function getSource() {
			return '27';
		}

		public function allowEditorToParse() {
			return true;
		}

		public function execute(array &$param_pool = null) {
			$result = new XMLElement($this->dsParamROOTELEMENT);

			try{
				$result = parent::execute($param_pool);
			}
			catch(FrontendPageNotFoundException $e){
				// Work around. This ensures the 404 page is displayed and
				// is not picked up by the default catch() statement below
				FrontendPageNotFoundExceptionHandler::render($e);
			}
			catch(Exception $e){
				$result->appendChild(new XMLElement('error', $e->getMessage()));
				return $result;
			}

			if($this->_force_empty_result) $result = $this->emptyXMLSet();

			return $result;
		}

	}
