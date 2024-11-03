<?php

namespace App\Filament\Resources\CommentResource\Widgets;

use App\Filament\Resources\CommentResource;
use App\Models\Comment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestComentsWidget extends BaseWidget
{
    protected array|string|int $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Comment::whereDate('created_at', '>', now()->subDays(14)->startOfDay())
            )
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('comment')
            ])->actions([
                // asign links to view btn
                Action::make('View')->url(fn (Comment $record) => CommentResource::getUrl('edit',['record' => $record]))
            ]);
    }
}
