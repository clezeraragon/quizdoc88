<?php

/**
 * Created by Clezer A.Ramos.
 * Date: Thu, 15 Nov 2018 15:02:07 +0000.
 */

namespace DockQuiz\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TopicsXProof
 * 
 * @property int $id
 * @property int $id_proof
 * @property int $id_topic
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \DockQuiz\Models\Proof $proof
 * @property \DockQuiz\Models\Topic $topic
 *
 * @package DockQuiz\Models
 */
class TopicsXProof extends Eloquent
{
	use SoftDeletes;

	protected $casts = [
		'id_proof' => 'int',
		'id_topic' => 'int'
	];

	protected $fillable = [
		'id_proof',
		'id_topic'
	];

	public function proof()
	{
		return $this->belongsTo(\DockQuiz\Models\Proof::class, 'id_proof');
	}

	public function topic()
	{
		return $this->belongsTo(\DockQuiz\Models\Topic::class, 'id_topic');
	}
}
