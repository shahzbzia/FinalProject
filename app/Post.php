<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Auth;

class Post extends Model implements HasMedia
{

	use SoftDeletes;
	use HasMediaTrait;
	use Sluggable;

    public $registerMediaConversionsUsingModelInstance = true;

    protected $fillable = [
        'title', 'slug', 'type', 'description', 'status', 'user_id', 'mainImage', 'subImages', 'url', 'sellable', 'royaltyFee', 'price', 'dContent', 'updated_by', 'download_id',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getTotalVoteCount(): int
    {
    	return $this->getTotalUpVoteCount() - $this->getTotalDownVoteCount();
    }

    public function getTotalUpVoteCount(): int
    {
    	return Vote::where('post_id', $this->id)->where('vote', 1)->count();
    }

    public function getTotalDownVoteCount(): int
    {
    	return Vote::where('post_id', $this->id)->where('vote', 0)->count();
    }

    public function checkIfUserHasVoted($voteType): bool
    {
    	$user = Auth::user();
    	$vote = Vote::where('post_id', $this->id)->where('user_id', $user->id)->where('vote', $voteType)->count();

    	if ($vote > 0) {
    		return true;    	
    	}

    	return false;
    }


    public function checkAndCreatePostUpVoteForUser($userId): bool
    {
    	$upVote = Vote::where('post_id', $this->id)->where('user_id', $userId)->where('vote', 1)->first();
    	$downVote = Vote::where('post_id', $this->id)->where('user_id', $userId)->where('vote', 0)->first();

    	if (null !== $downVote) {
            $downVote->delete();
        }

        if (null !== $upVote) {
            $upVote->delete();
            return false;
        }

        $upVote = Vote::create([
            'post_id' => $this->id,
            'user_id' => $userId,
            'vote' => 1,
        ]);

        return true;
    }

    public function checkAndCreatePostDownVoteForUser($userId): bool
    {
    	$upVote = Vote::where('post_id', $this->id)->where('user_id', $userId)->where('vote', 1)->first();
    	$downVote = Vote::where('post_id', $this->id)->where('user_id', $userId)->where('vote', 0)->first();

    	if (null !== $upVote) {
            $upVote->delete();
        }

        if (null !== $downVote) {
            $downVote->delete();
            return false;
        }

        $downVote = Vote::create([
            'post_id' => $this->id,
            'user_id' => $userId,
            'vote' => 0,
        ]);

        return true;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        // Watermark conversion
        $this->addMediaConversion('watermarked')
            ->watermark(public_path('/images/watermark.png'))
            ->watermarkOpacity(50)
            ->nonQueued()
            ->performOnCollections('images', 'others');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function votes()
    {
    	return $this->hasMany('App\Vote');
    }
}
