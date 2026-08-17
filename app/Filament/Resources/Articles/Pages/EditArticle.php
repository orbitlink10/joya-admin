<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('review')
                ->label('Review')
                ->url(fn () => route('admin.articles.review', $this->getRecord()))
                ->openUrlInNewTab(),
            Action::make('publish')
                ->label('Publish')
                ->color('success')
                ->action(function (): void {
                    $this->getRecord()->update([
                        'is_published' => true,
                        'published_at' => $this->getRecord()->published_at ?? now(),
                    ]);

                    $this->refreshFormData(['is_published', 'published_at', 'seo_score', 'seo_checks']);
                })
                ->visible(fn (): bool => ! $this->getRecord()->is_published),
            Action::make('draft')
                ->label('Save as Draft')
                ->color('gray')
                ->action(function (): void {
                    $this->getRecord()->update([
                        'is_published' => false,
                    ]);

                    $this->refreshFormData(['is_published', 'seo_score', 'seo_checks']);
                })
                ->visible(fn (): bool => $this->getRecord()->is_published),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        if ($data['is_published'] && blank($data['published_at'] ?? null)) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
