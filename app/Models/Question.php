<?php

namespace DockQuiz\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use function PHPSTORM_META\elementType;

/**
 * Class Question
 *
 * @package App
 * @property string $topic
 * @property text $question_text
 * @property text $code_snippet
 * @property text $answer_explanation
 * @property string $more_info_link
 */
class Question extends Model
{
    use SoftDeletes;

    protected $fillable = ['question_text', 'code_snippet', 'answer_explanation', 'more_info_link', 'topic_id'];

    public static function boot()
    {
        parent::boot();

        Question::observe(new \DockQuiz\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTopicIdAttribute($input)
    {
        $this->attributes['topic_id'] = $input ? $input : null;
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id')->withTrashed();
    }

    public function options()
    {
        return $this->hasMany(QuestionsOption::class, 'question_id')->withTrashed();
    }

    public static function getTopic($id)
    {
        $result = self::find($id);
        if (isset($result->topic)) {
            return $result->topic->title;
        } else {
            return 'sem tópico';
        }
    }
    public static function countQuetionsForTopic($id)
    {
        $result = self::find($id);
        if (isset($result->topic)) {
            return $result->topic->questions->count();
        } else {
            return 0;
        }
    }

}
