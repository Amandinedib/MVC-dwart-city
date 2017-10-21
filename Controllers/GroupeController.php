<?php

class GroupeController extends CoreController
{
    public function __construct()
    {
        parent::__construct('Groupe');
    }

    public function descriptionAction()
    {
        $error = '';
        $id = $this->getParameters('id');

        $Groupe = $this->getInstanceModel();
        $tavernesLibres = $this->getInstanceModel('taverne')->getListFreeById($id);

        if($this->getData('debut') && $this->getData('fin') && $this->getData('taverne'))
        {
            //Vérifier que la taverne en POST fait partie des tavernes libres
            $place = false;
            if($this->getData('taverne') === '')
            {
                $place = true;
            }
            else
            {
                foreach ($tavernesLibres as $taverne)
                {
                    if($this->getData('taverne') == $taverne['t_id'])
                    {
                        $place = true;
                        break;
                    }
                }
            }

            if($place)
            {
                try
                {
                    $result = $Groupe->update($this->getData('debut'), $this->getData('fin'), $this->getData('tunnel'), $this->getData('taverne'), $id);
                    if($result === false)
                        $error = 'Erreur';
                }
                catch(PDOException $e)
                {
                    $error = $e->getMessage();
                }
            }
            else
            {
                $error = "Nombre de places dans la taverne insuffisant!";
            }
        }

        if(!$error)
        {
            $groupe = $this->getInstanceModel()->getById($id)[0];
            $tunnels = $this->getInstanceModel('tunnel')->getList();
            $nains = $this->getInstanceModel('nain')->getListByIdGroupe($id);
        }

        require($this->getFolderView('description'));
    }

}