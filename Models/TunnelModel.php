<?php

class TunnelModel extends CoreModel{

	/**
	* @param int $id des villes d'arrivée et de départ
    * @return array int liste ID des tunnels
    */
    public function getListByIdVille($id){
        $listTunnels = $this->makeSelect( 'SELECT `tunnel`.*, dep.`v_nom` v_dep, ar.`v_nom` v_ar FROM `tunnel` JOIN `ville` dep ON `t_villedepart_fk`=dep.`v_id` JOIN `ville` ar ON `t_villearrivee_fk`=ar.`v_id` WHERE `t_villedepart_fk`=:id OR `t_villearrivee_fk`=:id', array('id'=>$id));

        return $listTunnels;
    }

    /**
    * @return array bool liste ID des tunnels
    */
    public function getList(){
        $tunnels =  $this->makeSelect('SELECT `t_id`, `t_progres`, dep.`v_nom` v_dep, ar.`v_nom` v_ar FROM `tunnel` JOIN `ville` dep ON `t_villedepart_fk` = dep.`v_id` JOIN `ville` ar ON `t_villearrivee_fk` = ar.`v_id`');

        return $tunnels;
    }
}
