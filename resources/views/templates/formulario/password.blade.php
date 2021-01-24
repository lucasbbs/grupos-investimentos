<label class="{{$class ?? null}}">
	<span>{{$label ?? $input}}</span>
	{!! Form::password($input, $attributes) !!}
</label>