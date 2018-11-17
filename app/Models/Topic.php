<?php
namespace DockQuiz\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\SelectorNode;

/**
 * Class Topic
 *
 * @package App
 * @property string $title
*/
class Topic extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];

    public static function boot()
    {
        parent::boot();

        Topic::observe(new \DockQuiz\Observers\UserActionsObserver);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'topic_id')->withTrashed();
    }
    public function test_answers()
    {
        return $this->hasMany(TestAnswer::class, 'topic_id')->withTrashed();
    }

}
