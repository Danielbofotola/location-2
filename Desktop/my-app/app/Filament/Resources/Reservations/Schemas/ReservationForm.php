<?php

namespace App\Filament\Resources\Reservations\Schemas;

use Filament\Forms\Components\{DatePicker, TextInput, TimePicker};
use Filament\Schemas\Schema;
use Filament\Schemas\Components\{Grid, Section};


class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
             ->components([
                Section::make('Informations du client')
                    ->description('Données personnelles du client')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nom')
                                    ->label('Nom')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('prenom')
                                    ->label('Prénom')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('numero_telephone')
                                    ->label('Numéro de téléphone')
                                    ->tel()
                                    ->required()
                                    ->maxLength(20),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Détails de la réservation')
                    ->description('Date, horaires et participants')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('date')
                                    ->label('Date de réservation')
                                    ->required()
                                    ->native(false),

                                TextInput::make('nombre_participants')
                                    ->label('Nombre de participants')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TimePicker::make('heure_debut')
                                    ->label('Heure de début')
                                    ->seconds(false)
                                    ->required(),

                                TimePicker::make('heure_fin')
                                    ->label('Heure de fin')
                                    ->seconds(false)
                                    ->required(),
                            ]),
                    ])
                    ->collapsible(),
        ]);
    }
}
