<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Product extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['institution_id', 'name', 'description', 'index', 'interest_rate'];

    public function institution()
    {
    	return $this->belongsTo(Institution::class);
	}
	

	public function valueFromUser(User $user)
	{
		$inflows  = $this->movements()->product($this)->applications()->sum('value');
		$outflows = $this->movements()->product($this)->outflows()->sum('value');
		return $inflows - $outflows;
	}

	public function movements()
	{
		return $this->hasMany(Movement::class);
	}

}
