<?php

class TaverneController extends CoreController{

	public function __construct(){
		parent::__construct('Taverne');
	}

	public function descriptionAction(){
		$id = $this->getParameters('id');

		$taverne = $this->getInstanceModel()->getListById($id)[0];

		require($this->getFolderView('description'));
	}
}