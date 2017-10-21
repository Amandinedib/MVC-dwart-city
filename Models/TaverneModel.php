<?php

class TaverneModel extends CoreModel{

	/**
    * @return array bool liste des tavernes
    */
    public function getListById($id)
    {
        $listTavernes = $this->makeSelect( 'SELECT `v_nom`, `taverne`.*, (`t_chambres` - COUNT(`n_id`) ) AS chambresLibres FROM `taverne` JOIN `ville` ON `t_ville_fk` = `v_id` LEFT JOIN `groupe` ON `t_id`=`g_taverne_fk` LEFT JOIN `nain` ON `g_id`=`n_groupe_fk` WHERE `t_id`=:id', array('id'=>$id));

        return $listTavernes;
    }

   	/**
    * @return array bool liste des tavernes libres
    */
    public function getListFreeById($id){
        $taverneLibre = $this->makeSelect('SELECT `t_id`, `t_nom`, `t_ville_fk`, (`t_chambres` - COUNT(`nain`.`n_id`)) AS chambresLibres FROM `taverne` LEFT JOIN `groupe` ON `t_id` = `g_taverne_fk` AND `g_id`!=:id LEFT JOIN `nain` ON `g_id` = `n_groupe_fk` GROUP BY `t_id` HAVING chambresLibres >= (SELECT COUNT(`n_id`) FROM `nain` WHERE `n_groupe_fk`=:id);', array('id'=>$id));

        return $taverneLibre;
    }

    /**
    * @return array bool liste des tavernes par id des villes
    */
    public function getListByIdVille($id){
        $listTavernes = $this->makeSelect( 'SELECT `t_id`,`t_nom` FROM `taverne` WHERE `t_ville_fk`=:id ORDER BY `t_nom` ASC', array('id'=>$id));

        return $listTavernes;
    }



    /**
    * @return array bool liste des tavernes par villes
    */
    public function getList(){
        $listTavernes = $this->makeSelect('SELECT `t_id`,`t_nom` FROM `taverne` ORDER BY `t_nom` ASC');

        return $listTavernes;
    }
}