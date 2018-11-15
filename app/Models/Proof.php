<?php

/**
 * Created by Clezer A.Ramos.
 * Date: Thu, 15 Nov 2018 15:01:32 +0000.
 */

namespace DockQuiz\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Proof
 * 
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property int $id_topic_pivot
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $topics
 *
 * @package DockQuiz\Models
 */
class Proof extends Eloquent
{
	use SoftDeletes;

	protected $casts = [
		'user_id' => 'int',
		'id_topic_pivot' => 'int'
	];

	protected $fillable = [
	    'title',
		'user_id',
		'id_topic_pivot'
	];

	public function topics()
	{
		return $this->belongsToMany(\DockQuiz\Models\Topic::class, 'topics_x_proofs', 'id_proof', 'id_topic')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
	public function users()
    {
        return $this->belongsTo( User::class,'user_id');
    }
}
