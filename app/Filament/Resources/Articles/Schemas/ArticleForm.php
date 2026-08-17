<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Support\ArticleSeoAnalyzer;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->maxLength(255),
                TextInput::make('slug')
                    ->helperText('Leave blank to generate automatically from the title.')
                    ->maxLength(255),
                Textarea::make('excerpt')
                    ->live(onBlur: true)
                    ->maxLength(255),
                RichEditor::make('body')
                    ->required()
                    ->live(onBlur: true)
                    ->columnSpanFull(),
                FileUpload::make('featured_image')
                    ->image()
                    ->directory('articles')
                    ->imageEditor(),
                TextInput::make('seo_title')
                    ->label('SEO title')
                    ->helperText('Best around 50-60 characters. Example: Wedding Flowers in Kenya | Joya Atelier')
                    ->live(onBlur: true)
                    ->maxLength(255),
                Textarea::make('seo_description')
                    ->label('SEO description')
                    ->helperText('Best around 150-160 characters. Write a clear reason someone should click.')
                    ->live(onBlur: true)
                    ->maxLength(170),
                TextInput::make('seo_keywords')
                    ->label('SEO keywords')
                    ->helperText('Example: wedding flowers Kenya, bridal bouquet Nairobi, event flowers')
                    ->live(onBlur: true)
                    ->maxLength(255),
                TextInput::make('canonical_url')
                    ->label('Canonical URL')
                    ->helperText('Optional. Use only if another URL is the main version of this article.')
                    ->maxLength(255),
                Textarea::make('seo_notes')
                    ->label('SEO checklist notes')
                    ->default("Keyword research\nUseful content\nGood on-page SEO\nFast/mobile-friendly page\nInternal linking\nLocal SEO\nBacklinks & authority\nGoogle Search Console monitoring\nContinuous improvement")
                    ->rows(5)
                    ->columnSpanFull(),
                Placeholder::make('seo_score')
                    ->label('SEO score')
                    ->content(function ($record, $get): string {
                        $analysis = ArticleSeoAnalyzer::analyze([
                            'title' => $get('title'),
                            'excerpt' => $get('excerpt'),
                            'body' => $get('body'),
                            'featured_image' => $get('featured_image'),
                            'seo_title' => $get('seo_title'),
                            'seo_description' => $get('seo_description'),
                            'seo_keywords' => $get('seo_keywords'),
                            'is_published' => $get('is_published'),
                        ]);

                        return "{$analysis['score']}%";
                    }),
                Placeholder::make('seo_checks')
                    ->label('SEO checklist result')
                    ->content(function ($get): string {
                        $analysis = ArticleSeoAnalyzer::analyze([
                            'title' => $get('title'),
                            'excerpt' => $get('excerpt'),
                            'body' => $get('body'),
                            'featured_image' => $get('featured_image'),
                            'seo_title' => $get('seo_title'),
                            'seo_description' => $get('seo_description'),
                            'seo_keywords' => $get('seo_keywords'),
                            'is_published' => $get('is_published'),
                        ]);

                        return collect($analysis['checks'])
                            ->map(fn ($check) => ($check['passed'] ? '[PASS] ' : '[TODO] ') . "{$check['name']} ({$check['points']} pts): {$check['recommendation']}")
                            ->implode("\n");
                    })
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('Published'),
                DateTimePicker::make('published_at'),
            ]);
    }
}
