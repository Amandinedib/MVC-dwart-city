<?php


    /**
    * Création du modèle groupe
    * @param int $id du groupe
    */
class GroupeModel extends CoreModel{
    public function getById($id){
        $groupe = $this->makeSelect('SELECT `groupe`.*, `t_nom`, dep.`v_nom` v_dep, ar.`v_nom` v_ar, `t_progres`, `t_villedepart_fk`, `t_villearrivee_fk` FROM `groupe` LEFT JOIN `taverne` ON `g_taverne_fk`=`taverne`.`t_id` LEFT JOIN `tunnel` ON `g_tunnel_fk`=`tunnel`.`t_id` LEFT JOIN `ville` dep ON `t_villedepart_fk` = dep.`v_id` LEFT JOIN `ville` ar ON `t_villearrivee_fk` = ar.`v_id` WHERE `g_id`=:id', array('id'=>$id));

        return $groupe;
    }
    /**
    * Création du modèle groupe
    * @return var $listGroupes array suivant l'ID des groupes de nains
    */
    public function getList(){
        $listGroupes = $this->makeSelect('SELECT `g_id` FROM `groupe` ORDER BY `g_id` ASC', array(), PDO::FETCH_COLUMN, 0);

        return $listGroupes;
    }


    /**
    * Mise à jour par rapport au changement de temps de travail / tunnels / groupes
    * @param int $debut heure du debut du travail
    * @param int $fin heure de fin du travail
    * @param int $tunnel id des tunnels
    * @param int $id des groupes
    */
    public function update($debut, $fin, $tunnel, $taverne, $id){
        $result = $this->makeStatement('UPDATE `groupe` SET `g_debuttravail`=:debut, `g_fintravail`=:fin, `g_taverne_fk`=:taverne, `g_tunnel_fk`=:tunnel WHERE `g_id`=:id',
                                            array('debut'=>$debut, 'fin'=>$fin, 'tunnel'=>$tunnel?:null, 'taverne'=>$taverne, 'id'=>$id));

        return $result;
    }
}