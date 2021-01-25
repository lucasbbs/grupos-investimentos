<?php

namespace App\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Database\QueryException;
use Exception;
  

class UserService
{
	private $repository;
	private $validator;

	public function __construct(UserRepository $repository, UserValidator $validator)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
	}

	public function store(array $data) : array
	{

		try{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$usuario = $this->repository->create($data);

			return [
				'success'=> true,
				'messages' => 'Usuário Cadastrado',
				'data' => $usuario
			];

		}
		catch(Exception $e)
		{
			return [
				'success' => false,
				'messages' => $e,
				$e,
			];
		}
	}
	public function update($data, $id){

		try{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$usuario = $this->repository->update($data, $id);

			return [
				'success'=> true,
				'messages' => 'Usuário atualizado',
				'data' => $usuario
			];

		}
		catch(Exception $e)
		{
			return [
				'success' => false,
				'messages' => $e,
				$e,
			];
		}
	}
	public function destroy($user_id)
	 {
		try{
			$this->repository->delete($user_id);

			return [
				'success'=> true,
				'messages' => 'Usuário Removido',
				'data' => null
			];

		}
		catch(Exception $e)
		{
			return [
				'success' => false,
				'messages' => $e,
				$e,
			];
		}
	}
}