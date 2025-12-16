<?php

namespace App\Filament\Resources\Reservations\Tables;

use Filament\Actions\{BulkActionGroup, DeleteAction, DeleteBulkAction, EditAction, ViewAction};
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ReservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('prenom')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('numero_telephone')
                    ->label('Téléphone')
                    ->searchable(),

                TextColumn::make('date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('heure_debut')
                    ->label('Début')
                    ->time('H:i'),

                TextColumn::make('heure_fin')
                    ->label('Fin')
                    ->time('H:i'),

                TextColumn::make('nombre_participants')
                    ->label('Participants')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state) => match (true) {
                        $state <= 5 => 'success',
                        $state <= 10 => 'warning',
                        default => 'danger',
                    }),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Filter::make('date')
                    ->label('Date de réservation')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('date'),
                    ])
                    ->query(fn (Builder $query, array $data) =>
                        $query->when(
                            $data['date'],
                            fn ($q) => $q->whereDate('date', $data['date'])
                        )
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
