<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class ItemForm extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //if user is admin accept
        //|- else if creating new item accept
        //|-- else if users updating one of their own items accept
        return $this->user() instanceof Admin ?
            true
            :
            ($this->routeIs('new item') ?
                true
                :
                ($this->item->user_id === $this->user()->id ?
                true
                :
                false)
            );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_intersect_key(
            Item::RULES,
            $this->all()
        );
    }
}