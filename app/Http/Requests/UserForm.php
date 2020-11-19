<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;


class UserForm extends FormRequest
{

    /**
     * if the request didn't change the email value,
     * we shouldn't validate it, that is because an email
     * must be unique
     */
    private function shouldValidateEmail($user){
        return //$user ?  
        User::find($user->id)->email !== $this->input('email')
       /* :
        false*/;
    }

    private function shouldValidatePassword($user){
        return is_null($user);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        //if user is admin accept
        //|- else if creating new user accept
        //|-- else if user updating it's own data accept
        return $this->user() instanceof Admin ?
        true
        :
        ($this->routeIs('new user') ?
            true
            :
            ($this->user->id === $this->user()->id ?
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
        $keys = ['name'];
        $user = $this->route('user');
        if( $this->shouldValidatePassword($user) ){
            //password is only validated when creating new user
            //so email should be validated
            array_push($keys, 'password', 'password_confirmation', 'email');
        }
        else if( $this->shouldValidateEmail($user) ){
            array_push($keys, 'email');
        }
        error_log(implode($keys));
        error_log('fdsfsd');
        return array_intersect_key(
            \App\Models\User::RULES,
            array_flip($keys)
            //array_intersect_key requires a map to work
        );
    }
}
