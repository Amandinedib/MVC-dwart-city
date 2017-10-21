<?php

class VilleController extends CoreController{

	public function __construct(){
		parent::__construct('Ville');
	}

	public function descriptionAction(){

		$id = $this->getParameters('id');

		$nains = $this->getInstanceModel('nain')->getListByIdVille($id);
		$ville = $this->getInstanceModel('ville')->getById($id)[0];
		$tavernes = $this->getInstanceModel('taverne')->getListByIdVille($id);
		$tunnels = $this->getInstanceModel('tunnel')->getListByIdVille($id);

		require($this->getFolderView('description'));
	}
}