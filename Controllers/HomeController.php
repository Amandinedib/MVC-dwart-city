<?php

class HomeController extends CoreController{

	public function __construct(){
		parent::__construct('Home');
	}

	public function listAction(){

		$nains = $this->getInstanceModel('nain')->getList();
		$villes = $this->getInstanceModel('ville')->getList();
		$tavernes = $this->getInstanceModel('taverne')->getList();
		$groupes = $this->getInstanceModel('groupe')->getList();

		require($this->getFolderView('list'));
	}
}
