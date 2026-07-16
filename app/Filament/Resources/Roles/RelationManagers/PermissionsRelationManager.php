<?php

namespace App\Filament\Resources\Roles\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('action')
                    ->required()
                    ->maxLength(255),
                TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                TextInput::make('columns')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('action')->sortable()->searchable(),
                TextColumn::make('model')->sortable()->searchable(),
                TextColumn::make('columns')
                    ->label('Columns')
                    ->formatStateUsing(function ($state) {
                        return is_array($state) ? implode(', ', $state) : $state;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->recordSelectOptionsQuery(function (Builder $query) {
                        return $query->select('permissions.id', 'permissions.name');
                    })

                    ->form(fn(AttachAction $action): array => [
                        $action->getRecordSelect()

                            //ตอนนี้ Filament Core จะมีฟังก์ชันเริ่มต้นชื่อ getInValidationRuleValues()
                            ///vendor/filament/forms/src/Components/Concerns/CanBeValidated.php(812): Filament/Forms/Components/Select->getInValidationRuleValues()
                            //ที่สั่งดึงข้อมูลเต็ม ๆ ด้วยคำสั่ง find() เพื่อเอาไปตรวจสอบความถูกต้อง
                            //ทำให้มีการ SELECT DISTINCT permissions.*
                            //->in() พร้อมใส่ Array ของ ID เข้าไปเพื่อ Override 
                            // เพื่อใช้ข้อมูลใน array แทนคำสั่ง find()
                            ->in(fn() => Permission::query()->pluck('id')->toArray()),
                    ])

                    ->action(function (array $data, $livewire): void {
                        $recordId = $data['recordId'];
                        $livewire->getOwnerRecord()
                            ->permissions()
                            ->syncWithoutDetaching([$recordId]);
                    }),

                    // ->using(function (\Illuminate\Database\Eloquent\Model $record, array $data): void {
                    //     $record->permissions()->syncWithoutDetaching([$data['recordId']]);
                    // }),
                    //ใช้ using() ไม่ได้เพราะมีตัวประมวลผลอื่น ๆ ที่ทำงานและมีการSELECT DISTINCT permissions.*
                    //เลยใช้ action() เพื่อทับการทำงานอย่างอื่น
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
