<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	public function site()
	{		
		$data = array("header_page"=> "Painel de Controle");
		return  view('template/site/index', $data);
	}

	public function empresas()
	{		
		$data = array("header_page"=> "Painel de Controle");
		return  view('template/site/empresas', $data);
	}

	public function motoboy()
	{		
		$data = array("header_page"=> "Painel de Controle");
		return  view('template/site/motoboy', $data);
	}

	public function quem_somos()
	{		
		$data = array("header_page"=> "Painel de Controle");
		return  view('template/site/quem_somos', $data);
	}

	public function contato()
	{
		$data = array("header_page"=> "Contato");
		return  view('template/site/contato', $data);
	}


}
