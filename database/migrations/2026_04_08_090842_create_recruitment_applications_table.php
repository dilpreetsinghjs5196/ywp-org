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
        Schema::create('recruitment_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('age');
            $table->string('phone');
            $table->string('how_did_you_hear_about_us');
            $table->string('department_preference_1')->nullable();
            $table->string('department_preference_2')->nullable();
            $table->string('department_preference_3')->nullable();
            $table->text('other_department_interests')->nullable();
            $table->text('motivation')->nullable();
            $table->text('mental_health_views')->nullable();
            $table->text('other_info')->nullable();
            $table->string('previous_participation')->nullable(); // Bootcamp etc
            $table->string('diversity_info')->nullable(); // Disability/Dalit etc
            $table->string('cv_path')->nullable();
            $table->string('status')->default('Pending'); // Pending, Approved, Rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruitment_applications');
    }
};
