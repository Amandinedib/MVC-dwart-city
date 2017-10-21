<?php

class NainModel extends CoreModel
{

    /**
     * @return array bool Liste des nains
     */
    public function getList()
    {
        $listNains = $this->makeSelect('SELECT `n_id`,`n_nom` FROM `nain` ORDER BY `n_nom` ASC');

        return $listNains;
    }

    public function getListByIdVille($id)
    {
        $listNains = $this->makeSelect('SELECT `n_id`,`n_nom` FROM `nain` WHERE `n_ville_fk`=:id ORDER BY `n_nom` ASC', array('id' =>$id));

        return $listNains;
    }

    public function getListByIdGroupe($id)
    {
        $listNains = $this->makeSelect('SELECT `n_id`,`n_nom` FROM `nain` WHERE `n_ville_fk`=:id ORDER BY `n_nom` ASC', array('id' =>$id));

        return $listNains;
    }

    /**
     * Met à jour le groupe du nain
     *
     * @param int $groupe
     * @param int $id
     * @return string $error
     */
    public function update($groupe, $id)
    {
        $error = '';
        try
        {
            if(($statement = $this->makeStatement('UPDATE `nain` SET `n_groupe_fk`=:group WHERE `n_id`=:id', array('group'=>$groupe, 'id'=>$id))) === false)
            {
                $error = 'Impossible de mettre à jour les données!';
            }
        }
        catch (PDOException $e)
        {
            $error = 'Impossible de mettre à jour les données : ' . $e->getMessage();
        }

        return $error;
    }

    /**
     * @param int $id
     * @return array bool Description d'un nain
     */
    public function getDescription($id)
    {
        $nain = $this->makeSelect(
            'SELECT `n_nom`, `n_barbe`, `n_groupe_fk`, `n_ville_fk`, `t_nom`, `g_debuttravail`, `g_fintravail`, `g_taverne_fk`, `t_villedepart_fk`, `t_villearrivee_fk`, Orig.`v_nom` v_natale, Dep.`v_nom` v_depart, Ar.`v_nom` v_arrivee 
                  FROM `nain` 
                      JOIN `ville` Orig ON `n_ville_fk` = Orig.`v_id` 
                      LEFT JOIN `groupe` ON `n_groupe_fk` = `g_id` 
                      LEFT JOIN `taverne` ON `g_taverne_fk` = `taverne`.`t_id` 
                      LEFT JOIN `tunnel` ON `g_tunnel_fk` = `tunnel`.`t_id` 
                      LEFT JOIN `ville` Dep ON `t_villedepart_fk` = Dep.`v_id` 
                      LEFT JOIN `ville` Ar ON `t_villearrivee_fk` = Ar.`v_id` 
                  WHERE `n_id`=:id', array('id'=>$id));

        return $nain;
    }
}