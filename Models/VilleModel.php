<?php

class VilleModel extends CoreModel{


	/**
	* @param int $id des villes
    * @return array int liste ID des villes
    */
	public function getById($id){
		$listVilles = $this->makeSelect('SELECT`v_nom`,`v_superficie` FROM `ville` WHERE `v_id`=:id', array('id'=>$id));

		return $listVilles;
	}


	/**
    * @return array bool liste ID des villes
    */
	public function getList(){
        $listVilles = $this->makeSelect('SELECT `v_id`,`v_nom` FROM `ville` ORDER BY `v_nom` ASC');

        return $listVilles;
    }
}