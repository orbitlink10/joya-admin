<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Brand')
                    ->description('Change the name, logo, and browser icon used by the admin area.')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Business name')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->imageEditor()
                            ->directory('settings')
                            ->helperText('Upload a logo to show in the admin header. Clear the file to remove it.'),
                        FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->imageEditor()
                            ->directory('settings')
                            ->helperText('Small icon shown in the browser tab.'),
                    ])
                    ->columns(2),
                Section::make('Contact Details')
                    ->schema([
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->maxLength(255),
                        TextInput::make('instagram')
                            ->maxLength(255),
                        TextInput::make('location')
                            ->maxLength(255),
                        Textarea::make('business_hours')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
