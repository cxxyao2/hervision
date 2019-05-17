<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Cache;

use Illuminate\Foundation\Http\FormRequest;

class CreateThreadRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {

        if (auth()->check()&& !auth()->user()->islocked()){

          return true;
        }
        else {
          return false;
        }

  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
      $titlelen = config('constants.thread_titlelen');
      $bodylen = config('constants.thread_bodylen');
        return [
          'title' => 'bail|required|unique:threads|spamfree|max:'.$titlelen,
          'body' => 'required|max:'.$bodylen,
          'channel_id' => 'required'

        ];
   }


      /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
       $bodylen = config('constants.thread_bodylen');
       return [
         'title.required' => 'A title is required',
         'body.required' => 'A body is required',
         'body.spamfree' => 'body不要录入垃圾内容',
         'title.spamfree' => 'title不要录入垃圾内容'
       ];
    }
}
