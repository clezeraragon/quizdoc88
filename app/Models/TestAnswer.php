<?php
namespace DockQuiz\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestAnswer
 *
 * @package App
 * @property string $question
 * @property string $option
 * @property tinyInteger $correct
*/
class TestAnswer extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'test_id', 'question_id','topic_id', 'option_id', 'correct'];

    public static function boot()
    {
        parent::boot();

        TestAnswer::observe(new \DockQuiz\Observers\UserActionsObserver);
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

}
