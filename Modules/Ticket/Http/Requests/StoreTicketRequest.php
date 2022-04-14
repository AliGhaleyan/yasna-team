<?php

namespace Modules\Ticket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Ticket\Entities\Ticket;

/**
 * Class StoreTicketRequest
 * @package Modules\Ticket\Http\Requests
 *
 * @property $title
 * @property $description
 * @property $status
 * @property $name
 * @property $email
 */
class StoreTicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "title"       => "required|string",
            "description" => "required|string",
            "status"      => "required|string|in:" . implode(",", Ticket::getAllStatuses()),
        ];

        if (!Auth::guard("api")->check())
            $rules = array_merge($rules, [
                "name"  => "required|string",
                "email" => "required|email"
            ]);

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
