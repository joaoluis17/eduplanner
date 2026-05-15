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
        Schema::create('weekly_plannings', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Informacoes Gerais
            |--------------------------------------------------------------------------
            */

            $table->string('school_name');
            $table->string('teacher_name');
            $table->string('segment');
            $table->date('week_date');

            /*
            |--------------------------------------------------------------------------
            | Segunda-feira
            |--------------------------------------------------------------------------
            */

            $table->text('monday_reading')->nullable();
            $table->text('monday_learning_objectives')->nullable();
            $table->text('monday_pedagogical_proposal')->nullable();
            $table->text('monday_development')->nullable();
            $table->text('monday_specialists_schedule')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Terca-feira
            |--------------------------------------------------------------------------
            */

            $table->text('tuesday_reading')->nullable();
            $table->text('tuesday_learning_objectives')->nullable();
            $table->text('tuesday_pedagogical_proposal')->nullable();
            $table->text('tuesday_development')->nullable();
            $table->text('tuesday_specialists_schedule')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Quarta-feira
            |--------------------------------------------------------------------------
            */

            $table->text('wednesday_reading')->nullable();
            $table->text('wednesday_learning_objectives')->nullable();
            $table->text('wednesday_pedagogical_proposal')->nullable();
            $table->text('wednesday_development')->nullable();
            $table->text('wednesday_specialists_schedule')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Quinta-feira
            |--------------------------------------------------------------------------
            */

            $table->text('thursday_reading')->nullable();
            $table->text('thursday_learning_objectives')->nullable();
            $table->text('thursday_pedagogical_proposal')->nullable();
            $table->text('thursday_development')->nullable();
            $table->text('thursday_specialists_schedule')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Sexta-feira
            |--------------------------------------------------------------------------
            */

            $table->text('friday_reading')->nullable();
            $table->text('friday_learning_objectives')->nullable();
            $table->text('friday_pedagogical_proposal')->nullable();
            $table->text('friday_development')->nullable();
            $table->text('friday_specialists_schedule')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Campos Finais
            |--------------------------------------------------------------------------
            */

            $table->text('weekly_report')->nullable();
            $table->text('materials_request')->nullable();
            $table->text('coordinator_feedback')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_plannings');
    }
};
