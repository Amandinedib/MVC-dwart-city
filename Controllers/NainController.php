<?php

class NainController extends CoreController
{
    public function __construct()
    {
        parent::__construct('Nain');
    }

    public function descriptionAction()
    {
        $error = '';

        try
        {
            $oNain = $this->getInstanceModel();

            if($this->getData('new_group'))
            {
                $oNain->update($this->getData('new_group'), $this->getParameters('id'));
            }

            $nain = $oNain->getDescription($this->getParameters('id'))[0];

            $oGroupe = $this->getInstanceModel('Groupe');
            $groupes = $oGroupe->getList();
        }
        catch (PDOException $e)
        {
            $nain = false;
            $error .= ($error === '' ? '' : ' - ') . $e->getMessage();
        }

        require($this->getFolderView('description'));
    }

}