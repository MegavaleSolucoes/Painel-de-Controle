<?php 

class CadastroController extends \HXPHP\System\Controller
{
	public function CadastrarAction()
	{
		$this->view->setFile('index');

		$this->request->setCustomFilters(array(
				'email' => FILTER_VALIDATE_EMAIL

			));

		$post = $this->request->post();

		if (!empty($post)) {
			$cadastrarUsuario = User::cadastrar($post);

			var_dump($cadastrarUsuario);
		}			
	}
}