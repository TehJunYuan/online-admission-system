<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Semester;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\ProgrammeRecord;
use Filament\Resources\Resource;
use App\Models\SemesterYearMapping;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProgrammeRecordResource\Pages;
use App\Filament\Resources\ProgrammeRecordResource\RelationManagers;

class ProgrammeRecordResource extends Resource
{
    protected static ?string $model = ProgrammeRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $activeNavigationIcon = 'heroicon-s-chart-bar';

    protected static ?string $navigationGroup = 'Form Components';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('semester_year_mapping_id')
                    ->options(function () {
                        return SemesterYearMapping::with('semester')->get()
                            ->mapWithKeys(function ($mapping) {
                                return [$mapping->id => "{$mapping->semester->semester} ({$mapping->year})"];
                            })
                            ->all();
                    })
                    ->required(),
                Select::make('programme_id')
                    ->relationship('programme','en_name')
                    ->preload()
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('semesterYearMapping.year')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('semesterYearMapping.semester.semester')
                    ->searchable(),
                TextColumn::make('programme.en_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                //
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                ForceDeleteAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => Pages\ListProgrammeRecords::route('/'),
            'create' => Pages\CreateProgrammeRecord::route('/create'),
            'edit' => Pages\EditProgrammeRecord::route('/{record}/edit'),
        ];
    }    
}
