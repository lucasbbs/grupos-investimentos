<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovementCreateRequest;
use App\Http\Requests\MovementUpdateRequest;
use App\Repositories\MovementRepository;
use App\Validators\MovementValidator;
use App\Entities\{Group, Product, Movement};
use Auth;

class MovementsController extends Controller
{

    /**
     * @var MovementRepository
     */
    protected $repository;

    /**
     * @var MovementValidator
     */
    protected $validator;

    public function __construct(MovementRepository $repository, MovementValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

	public function index()
	{
		return view('movement.index', [
			'product_list' => Product::all(),
		]);
	}

    public function application()
    {
        $user           = Auth::user();
        $group_list     = $user->groups->pluck('name', 'id');
        // $group_list 	= Group::all()->pluck('name', 'id');
        $product_list   = Product::all()->pluck('name', 'id');

        return view('movement.application', [
            'group_list'    => $group_list,
            'product_list'  => $product_list,
        ]);
	}
	
	public function storeApplication(Request $request)
	{
		$movement = Movement::create([
			'user_id' 		=> Auth::user()->id, 
			'group_id' 		=> $request->get('group_id'), 
			'product_id' 	=> $request->get('product_id'), 
			'value' 		=> $request->get('value'), 
			'type' 			=> 1,
		]);

		session()->flash('success', [
			'success' => true,
			'messages' => "Sua aplicação de " . $movement->value . " no produto " . $movement->product->name . " foi realizada com sucesso!",
		]);

		return redirect()->route('movement.application');
	}

    public function getback()
    {
        $user           = Auth::user();
        $group_list     = $user->groups->pluck('name', 'id');
        $product_list   = Product::all()->pluck('name', 'id');

        return view('movement.getback', [
            'group_list'    => $group_list,
            'product_list'  => $product_list,
        ]);
	}
	
	public function storeGetBack(Request $request)
	{
		$movement = Movement::create([
			'user_id' 		=> Auth::user()->id, 
			'group_id' 		=> $request->get('group_id'), 
			'product_id' 	=> $request->get('product_id'), 
			'value' 		=> $request->get('value'), 
			'type' 			=> 2,
		]);

		session()->flash('success', [
			'success' => true,
			'messages' => "Seu resgate de " . $movement->value . " no produto " . $movement->product->name . " foi realizado com sucesso!",
		]);

		return redirect()->route('movement.application');
	}

	public function all()
	{
		$movement_list = Auth::user()->movements;

		return view('movement.all', [
			'movement_list' => $movement_list,
		]);
	}
}



















