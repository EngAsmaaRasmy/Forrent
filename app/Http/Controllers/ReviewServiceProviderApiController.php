<?php

namespace App\Http\Controllers;

use App\Models\ReviewServiceProvider;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Traits\TranslationTrait;
use Validator;

class ReviewServiceProviderApiController extends Controller
{
    use ApiResponser;
    use TranslationTrait;

    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $review = ReviewServiceProvider::find($id);
        if (!$review) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'review' => 'required'
            ]);
            if ($validator->fails()) {
                $message = implode("\n", $validator->errors()->all());
                return $this->error($message, 422, $validator->errors());
            }
            $review = ReviewServiceProvider::create($input);
            $review->save();
            $this->translate($request, 'ReviwServiceProvider', $review->id);
            return $this->success(['review' => $review], trans('main.review_create_success'));
        }
        $validator = Validator::make($input, [
            'review' => 'required',
        ]);
        if ($validator->fails()) {
            $message = implode("\n", $validator->errors()->all());
            return $this->error($message, 422, $validator->errors());
        }
        $review->update($input);
        //dd($reviews);

        $this->translate($request, 'review', $review->id);
        return $this->success(['review' => $review], trans('main.review_update_success'));
    }

}

