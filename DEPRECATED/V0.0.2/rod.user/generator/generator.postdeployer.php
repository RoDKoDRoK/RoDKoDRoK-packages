<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//init menus
$instanceMenu=null;
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
	$instanceMenu=new PratikMenu($this->initer);


foreach($this->confgenerator->instance as $instance)
{
	//ajout des droits
	if(isset($this->instanceDroit))
	{
		$cptmenu=0;
		
		//droit des pages
		$tabfilestoload=$this->loader->charg_dossier_dans_tab("package/rod.user/generator/index/core/dev/page");
		if(isset($tabfilestoload))
			foreach($tabfilestoload as $filecour)
			{
				$file=substr($filecour,strrpos($filecour,"/"),strlen($filecour)-4-strrpos($filecour,"/"));
				$file=substr($file,1,-4);
				$elmtcour=str_replace("__INSTANCE__",$instance->name,$file);
				
				//recup du droit
				$droitcour=$instance->droits->edit;
				if(strstr($elmtcour,"form")===false)
					$droitcour=$instance->droits->view;
				
				$this->instanceDroit->addGrantTo($elmtcour,"page",$droitcour);
				
				if($instanceMenu)
				{
					//test page avec menu
					if(strstr($elmtcour,"list")===false)
						continue;
					
					$suitemenu="";
					if($cptmenu>0)
						$suitemenu=$cptmenu;
						
					$instanceMenu->addMenu($elmtcour,'main',ucfirst($instance->name).$suitemenu,'?page='.$elmtcour,'','fr_fr','96');
					$this->instanceDroit->addGrantTo($elmtcour,'menu',$instance->droits->view);
					
					$cptmenu++;
				}
			}
		
		//droit des ws
		$tabfilestoload=$this->loader->charg_dossier_dans_tab("package/rod.user/generator/ws/core/ws/flux");
		if(isset($tabfilestoload))
			foreach($tabfilestoload as $filecour)
			{
				$file=substr($filecour,strrpos($filecour,"/"),strlen($filecour)-4-strrpos($filecour,"/"));
				$file=substr($file,1,-4);
				$elmtcour=str_replace("__INSTANCE__",$instance->name,$file);
				
				//recup du droit
				$droitcour=$instance->droits->wsedit;
				if(strstr($elmtcour,"action")===false)
					$droitcour=$instance->droits->wsview;
					
				$this->instanceDroit->addGrantTo($elmtcour,"ws",$droitcour);
				
			}
	}

}

?>