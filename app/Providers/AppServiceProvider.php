<?php

namespace DockQuiz\Providers;

use DockQuiz\Question;
use DockQuiz\QuestionsOption;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Question::deleting(function ($question) {
            $question->options()->delete();
        });


        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MENU');
            
            $event->menu->add([
                'url' => route('all.topics'),
                'text' => trans('quickadmin.test.new'),
                'icon' => 'file-text-o'
            ]);

            $event->menu->add([
                'url' => route('results.index'),
                'text' => trans('quickadmin.results.title'),
                'icon' => 'line-chart'
            ]);

            $event->menu->add([
                'url' => route('topics.index'),
                'text' => trans('quickadmin.topics.title'),
                'icon' => 'list',
                'can' => 'admin-site'
            ]);

            $event->menu->add([
                'url' => route('questions.index'),
                'text' => trans('quickadmin.questions.title'),
                'icon' => 'question-circle',
                'can' => 'admin-site'
            ]);

            $event->menu->add([
                'url' => route('questions_options.index'),
                'text' => trans('quickadmin.questions-options.title'),
                'icon' => 'gears',
                'can' => 'admin-site'
            ]);

            $event->menu->add([
                'text' => trans('quickadmin.user-management.title'),
                'icon' => 'users',
                'can' => 'admin-site',
                'submenu' => [
                    [
                        'url'  => route('roles.index'),
                        'text' => trans('quickadmin.roles.title'),
                        'icon' => 'briefcase',
                    ],
                    [
                        'url'  => route('users.index'),
                        'text' => trans('quickadmin.users.title'),
                        'icon' => 'user',
                    ],
                    [
                        'url'  => route('user_actions.index'),
                        'text' => trans('quickadmin.user-actions.title'),
                        'icon' => 'th-list',
                    ]
                ]
            ]);

            $event->menu->add([
                'url' => route('questions_options.index'),
                'text' => trans('logout'),
                'icon' => 'arrow-left',
                'active' => ['logout']
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
