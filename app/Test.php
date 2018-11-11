<?php
namespace DockQuiz;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Test
 *
 * @package App
 * @property string $title
*/
class Test extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'result'];

    public static function boot()
    {
        parent::boot();

        Test::observe(new \DockQuiz\Observers\UserActionsObserver);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getTopicForQuestion()
    {
        return $this->hasOne(TestAnswer::class, 'test_id')->withTrashed();
    }
}
