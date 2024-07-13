<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\RatingParticipant;
use App\Trait\HelperTrait;
use Illuminate\Http\Request;

class RatingParticipantController extends Controller
{
    use HelperTrait;
    public function storeRating(Request $request, Package $package)
    {
      
        $isRatinged = RatingParticipant::where('rating_id' , $package->rating->id)->where('user_id' , auth()->user()->id)->first();
      
        if(!$isRatinged){

            if($request->feedback == 'good'){
                $package->rating()->update([
                    'uuid' => $this->setUuid(),
                    'good' => $package->rating->good + 1
                ]);
            }elseif($request->feedback == 'normal'){
                $package->rating()->update([
                    'uuid' => $this->setUuid(),
                    'normal' => $package->rating->normal + 1
                ]);
            }elseif($request->feedback == 'bad'){
                $package->rating()->update([
                    'uuid' => $this->setUuid(),
                    'bad' => $package->rating->bad + 1
                ]);
            }

            RatingParticipant::create([
                'uuid' => $this->setUuid(),
                'rating_id' => $package->rating->id,
                'user_id' =>  auth()->user()->id,
                'selected' => $request->feedback
            ]);
        }else{
            if ($isRatinged->selected != $request->feedback) {
              
                $isRatingedSelected = $isRatinged->selected;
                $requestFeedback = $request->feedback;
                
                $rating = $package->rating;
                
                $rating->$isRatingedSelected -= 1; // Mengurangi rating sebelumnya
                $rating->$requestFeedback += 1; // Menambah rating baru
                
                $package->rating()->update([
                    $isRatingedSelected => $rating->$isRatingedSelected,
                    $requestFeedback => $rating->$requestFeedback,
                ]);
            
                $isRatinged->selected = $request->feedback;
                $isRatinged->save();
            }
            
        }

        return back()->with('ratinged' , 'Rating berhasil diberikan');
    }
}
