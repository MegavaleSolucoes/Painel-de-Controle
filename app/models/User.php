<?php 

class User extends \HXPHP\System\Model
{
	static $validates_presence_of = array(
			array(
				'name',
				'message' => 'O Nome é um campo Obrigatório.'
			),
			array(
				'email',
				'message' => 'O E-mail é um campo Obrigatório.'
			),
			array(
				'username',
				'message' => 'O Nome de Usuário é um campo Obrigatório.'
			),
			array(
				'password',
				'message' => 'A Senha de Usuário é um campo Obrigatório.'
			),
		);
	static $validates_uniqueness_of = array(
		array(
			array('username', 'email'),
			'message' => 'Já existe um usuário com este e-mail e/ou nome cadastrado!'
			)
  	    );

	public static function cadastrar(array $post)
	{
		$userObj = new \stdClass;
		$userObj->user = null;
		$userObj->status = false;
		$userObj->errors = array();

		$role = Role::find_by_role('user2');

		if (is_null($role)) {
			array_push($userObj->errors, 'A Role user não existe. Contate a Megavale Soluções para Resolver o Problema!');

			return $userObj;
		}

		$post = array_merge($post, array(
				'role_id' => $role->id,
				'status' => 1
			));

		$password = \HXPHP\System\Tools::hashHX($post['password']);

		$post = array_merge($post, $password);

		$cadastrar = self::create($post);

		if ($cadastrar->is_valid()){
			$userObj->user = $cadastrar;
			$userObj->status = true;
			return $userObj;
		}

		$errors = $cadastrar->errors->get_raw_errors();

		foreach ($errors as $field => $message) {

			array_push($userObj->errors, $message[0]);
		}

		return $userObj;

	}	
}