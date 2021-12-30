<?php

namespace App\Http\Requests;

use App\Models\FriendRequest;
use Illuminate\Foundation\Http\FormRequest;

class FriendRequestActionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $friendRequest = FriendRequest::query()->where('id', $this->request->get('id'))->firstOrFail();

        return auth()->user()->id === $friendRequest->target_user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:friend_requests,id',
        ];
    }
}
