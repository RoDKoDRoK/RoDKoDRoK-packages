<?php

class PackageConf extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function form_loader()
	{
		$form=array();
		
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		$update=$this->instanceVar->varpost("update");
		
		//prepare form with pratikpackage
		$preform=array();
		if($this->includer->include_pratikclass("Package"))
		{
			$instancePackage=new PratikPackage($this->initer);
			$instancePackage->getPackageFromRoDKoDRoKCom($packagecodename,$update);
			$preform=$instancePackage->preparePackageConfForm($packagecodename);
		}
		
		//preform reload option
		$preform['lineform'][]=array();
		$preform['lineform'][count($preform['lineform']) -1]['label']="Reload";
		$preform['lineform'][count($preform['lineform']) -1]['hiddenlabel']="on";
		$preform['lineform'][count($preform['lineform']) -1]['name']="reload";
		$preform['lineform'][count($preform['lineform']) -1]['default']="canceled";
		$preform['lineform'][count($preform['lineform']) -1]['champs']="hidden";
		
		//construct form
		if($this->includer->include_pratikclass("Form"))
		{
			$instanceForm=new PratikForm($this->initer);
			$tabparam['codename']=$packagecodename;
			$form=$instanceForm->formconverter($preform,$tabparam);
		}
	
		return $form;
	}

	
	function data_loader()
	{
		$data=array();
		
		$deployed=$this->instanceVar->varpost("deployed");
		$data['deployed']=$deployed;
		
		$update=$this->instanceVar->varpost("update");
		$data['update']=$update;
		
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		$data['dependok']="1";
		if($this->includer->include_pratikclass("Package"))
		{
			$instancePackage=new PratikPackage($this->initer);
			if($instancePackage->checkDependAreDeployedForPackage($packagecodename))
				$data['dependok']="0";
		}
	
		return $data;
	}
	
	
	function windowcontent_loader()
	{
		$content="";
		
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		$deployed=$this->instanceVar->varpost("deployed");
		$update=$this->instanceVar->varpost("update");
		
		
		//check deployed
		if($deployed && $update)
			$content.=$this->instanceLang->getTranslation("Mise à jour de ce package ?");
		else if($deployed)
			$content.=$this->instanceLang->getTranslation("Détruire ce package ?");
		else
			$content.=$this->instanceLang->getTranslation("Déployer ce package ?");
		
		
		//check depend
		if($this->includer->include_pratikclass("Package"))
		{
			$instancePackage=new PratikPackage($this->initer);
			if(!$instancePackage->checkDependAreDeployedForPackage($packagecodename))
			{
				$content.="<br /><br />".$this->instanceLang->getTranslation("Dépendances manquantes, vérifiez :")."<br />";
				if(file_exists("package/".$packagecodename."/package.descripter.php"))
					include "package/".$packagecodename."/package.descripter.php";
		
				if(isset($descripter['depend']) && is_array($descripter['depend']))
					foreach($descripter['depend'] as $dependcour)
						$content.=$dependcour." ";
			}
		}
		
		
		return $content;
	}
	
	
	function windowtitle_loader()
	{
		$content="";
		
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		$deployed=$this->instanceVar->varpost("deployed");
		
		$content.="<h2>".$this->instanceLang->getTranslation("Package ").$packagecodename."</h2>";
	
		return $content;
	}
}


?>