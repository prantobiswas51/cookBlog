<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;
use Filament\Tables\Columns\ImageColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Main Content')->schema(
                    [
                        TextInput::make('title')->live()->required()->minLength(2)->maxLength(150)
                        ->afterStateUpdated(function(string $operation, $state, Forms\Set $set){
                            if($operation === 'edit'){return;}
                            $set('slug', Str::slug($state));
                        }),
                        TextInput::make('slug')->required()->unique(ignoreRecord:true),
                        RichEditor::make('body')->required()->fileAttachmentsDirectory('posts/images')->columnSpanFull(),
                    ]
                )->columns(2),

                Section::make('Meta')->schema(
                    [
                        FileUpload::make('image')->image()->directory('posts/thumbnails'),
                        DateTimePicker::make('published_at')->nullable(),
                        Checkbox::make('featured'),
                        Select::make('user_id')->relationship('author','name')->searchable()->required(),
                        Select::make('cetegories')->relationship('categories','title')->searchable()->required()->multiple()
                    ]
                ),

                Section::make('Comments')->schema(
                    [
                        TextInput::make('comment')
                    ]
                ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('published_at')->sortable()->searchable(),
                TextColumn::make('featured'),
                TextColumn::make('author.name')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
