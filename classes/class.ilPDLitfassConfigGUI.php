<?php

include_once("./Services/Component/classes/class.ilPluginConfigGUI.php");
 
/**
 *
 * @author Marko Glaubitz, Johannes Heim <ilias@rz.uni-freiburg.de>
 * @version $Id$
 *
 */
class ilPDLitfassConfigGUI extends ilPluginConfigGUI
{
	/**
	* Handles all commmands, default is "configure"
	*/
	function performCommand($cmd)
	{

		switch ($cmd)
		{
			case "configure":
			case "save":
				$this->$cmd();
				break;

		}
	}

	/**
	 * Configure screen
	 */
	function configure()
	{
		global $tpl;

		$form = $this->initConfigurationForm();
		$tpl->setContent($form->getHTML());
	}
	
	//
	
	/**
	 * Init configuration form.
	 *
	 * @return object form object
	 */
	public function initConfigurationForm()
	{
		global $ilCtrl, $lng, $ilDB;
		
		$pl = $this->getPluginObject();

		$id = $this->getcurrentID();
	
		include_once("Services/Form/classes/class.ilPropertyFormGUI.php");
		$form = new ilPropertyFormGUI();
		
		// Show Block?
		$cb = new ilCheckboxInputGUI($pl->txt("show_block"), "show_block");
		$cb -> setValue(1);
		$checked = $this->getConfigValue($id); 
		$cb->setChecked($checked[display]);
		$form->addItem($cb);
		
		//PDLitfass Info Title
                $litfass_title =  new ilTextInputGUI($pl->txt("litfass_title"), "litfass_title");
                $litfass_title->setRequired(true);
                $littitle = $this->getConfigValue($id);
                $litfass_title->setValue($littitle[title]);
                $form->addItem($litfass_title);
		
		// PDLitfass Info message
		$litfass_message = new ilTextAreaInputGUI($pl->txt("litfass_message"), "litfass_message");
		$litfass_message->setRequired(true);
		$litmessage =	$this->getConfigValue($id);
		$litfass_message->setValue($litmessage[message]);
		$form->addItem($litfass_message);

		// Save Button
		$form->addCommandButton("save", $lng->txt("save"));
		$form->setTitle($pl->txt("litfass_configuration"));
		$form->setFormAction($ilCtrl->getFormAction($this));
		
		return $form;
	}
	
	/**
	 * Save form input 	 *
	 */
	public function save()
	{
		global $tpl, $lng, $ilCtrl, $ilDB;
	
		$pl = $this->getPluginObject();
		
		$form = $this->initConfigurationForm();
		if ($form->checkInput())
		{
			$litfass_message = $form->getInput("litfass_message");
			$litfass_title = $form->getInput("litfass_title"); 	
			$cb = $form->getInput("show_block");
			$id = $ilDB->nextID('ui_uihk_litfass_config');				
			
			// store Values

			$this->storeConfigValue($id, $cb, $litfass_message, $litfass_title);	
			ilUtil::sendSuccess($pl->txt("saving_invoked"), true);
			$ilCtrl->redirect($this, "configure");
		}
		else
		{
			$form->setValuesByPost();
			$tpl->setContent($form->getHtml());
		}
	}


		protected function storeConfigValue($id, $display, $litfass_message, $litfass_title)
		{
			global $ilDB;
			
			if($this->getConfigValue('1'))
				$sql = "INSERT INTO `ui_uihk_litfass_config` (`id`,`display`,`message`, `title`)
						VALUES (
							{$ilDB->quote($id, "text")},
							{$ilDB->quote($display, "text")},
							{$ilDB->quote($litfass_message, "text")},
							{$ilDB->quote($litfass_title, "text")})";
			
			else
				$sql = "UPDATE `ui_uihk_litfass_config`
				SET `message` = {$ilDB->quote($message, "text")}
				WHERE `id` = {$ilDB->quote($id, "text")}";
			return $ilDB->manipulate($sql);
			
		}
		
		public function getConfigValue($id)
		{ 
			if (!$id)
				$id = 1;
 
			global $ilDB;
	
			$sql = $ilDB->query("SELECT *   
					FROM `ui_uihk_litfass_config`
					WHERE `id` = $id");

			$row = $ilDB->fetchAssoc($sql);
			//print_r($row);	
			return $row;	

		}

		public function getcurrentID()
		{
  
                         global $ilDB;
         
                         $sql = $ilDB->query("SELECT *   
                                         FROM `ui_uihk_litfass_config_seq`
                                         ");
 
                         $row = $ilDB->fetchAssoc($sql);
                         //print_r($row);        
                         return $row[sequence]; 
		}
}
?>
