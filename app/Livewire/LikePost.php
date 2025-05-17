<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class LikePost extends Page
{
    use InteractsWithActions;
    use InteractsWithForms;

    public Post $post;

    public int $postId;

    public function mount(int $postId): void
    {
        $this->post = Post::find($postId);
    }

    public function loveAction(): Action
    {
        return Action::make('love')
            //->size(ActionSize::ExtraLarge)
            ->icon(function () {
                /** @var User $user */
                $user = auth()->user();
                return (
                    auth()->check() && $user->hasLiked($this->post)
                )
                    ? 'tabler-heart-filled'
                    : 'tabler-heart';
            })
            ->tooltip('Love it')
            ->button()
            ->label((string) $this->post->likes()->count())
            ->color(fn () => (! auth()->check()) ? 'gray' : 'danger')
            ->action(function () {
                if (! auth()->check()) {
                    Notification::make()
                        ->title('Please login first')
                        ->danger()
                        ->send();

                    return;
                }

                if ($this->post->love()) {
                    Notification::make()
                        ->title('Your likes never fail to lift my spirits!')
                        ->success()
                        ->send();
                } else {
                    Notification::make()
                        ->title('No harm, No foul')
                        ->info()
                        ->send();
                }
            });
    }

    public function render(): View
    {
        return view('livewire.like-post');
    }
}
