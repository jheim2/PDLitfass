<#1>
<?php
//$sql = "INSERT INTO `ui_uihk_litfass_config` (`id`,`display`,`message`, `title`, `employee`,`student`,`eroles`,`sroles`) VALUES (`1`,`0`,`Nachricht`,`Titel`,`0`,`0`,`2,233`,`266`)"
                        //        $sql = "INSERT INTO `ui_uihk_litfass_config` (`id`,`display`,`message`, `title`, `employee`,`student`,`eroles`,`sroles`)
                         //                       VALUES (
                           //                             {$ilDB->quote("1", "text")},
                             //                           {$ilDB->quote("0", "text")},
                               //                         {$ilDB->quote("Nachricht", "text")},
                                 //                       {$ilDB->quote("Titel", "text")},
                                   //                     {$ilDB->quote("0", "text")},
                                     //                   {$ilDB->quote("0", "text")},
                                       //                 {$ilDB->quote("2,233", "text")},
                                         //               {$ilDB->quote("266", "text")})";

	$fields = array(
		'id'=>array(
			'type'=>'integer',
			'length'=>2
		),
		'display'=>array(
			'type'=>'integer',
			'length'=>2
		),
		'message'=>array(
			'type'=>'text',
			'length'=>300
		),
		'title'=>array(
			'type'=>'text',
			'length'=>300
		),
		'roles'=>array(
			'type'=>'text',
			'length'=>15
		),
		'employee'=>array(
			'type'=>'integer',
			'length'=>2
		),
               'student'=>array(
               		'type'=>'integer',
               		'length'=>2
                ),
               'eroles'=>array(
                        'type'=>'text',
                        'length'=>300
                ),
               'sroles'=>array(
                        'type'=>'text',
                        'length'=>300
                ),	
	       'position'=>array(
                        'type'=>'text',
                        'length'=>10	);
	
	$ilDB->createTable('ui_uihk_litfass_config', $fields);
	$ilDB->addPrimaryKey('ui_uihk_litfass_config', array('id'));
	$ilDB->createSequence('ui_uihk_litfass_config');
//	$ilDB->manipulate($sql);

?>



<#2>
<?php
if(!$ilDB->tableColumnExists('ui_uihk_litfass_config', 'position'))
{
	$ilDB->addTableColumn('ui_uihk_litfass_config', 'position',
		array(
			'type'    => 'text',
			'length'  => '15'
		)
	);
}
?>

<#3>
<?php
//if(!$ilDB->tableExists('ui_uihk_litfass_messages_ids'))
{
		$fields = array(
		'message_id'=>array(
			'type'	=>	'integer',
			'length'=>	2
		),
		'user_id'=>array(
			'type'	=>'integer',
			'length'=>	2 
		)
	);

	$ilDB->createTable('ui_uihk_litfass_messages_ids', $fields);

}
?>
