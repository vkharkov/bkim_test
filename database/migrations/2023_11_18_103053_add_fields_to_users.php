<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            /**
             * Сделано так в рамках тестового задания, в большом проекте требуется несколько ролей
             * и лучше использовать связи в отдельной таблице
             */
            $table->string('role')->after('id')->index();

            /** Добавим сразу авторизацию по телефону на будущее */
            $table->after('password', function (Blueprint $table){

                $table->string('phone')
                    ->unique()
                    ->nullable();
                $table->string('auth_code', 10)->nullable();
                $table->timestamp('auth_code_expire_at')->nullable();
            });
            $table->boolean('register_complete')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'phone',
                'auth_code',
                'auth_code_expire_at',
                'register_complete'
            ]);
        });
    }
};
