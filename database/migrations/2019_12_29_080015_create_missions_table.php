<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('mission_type');
            $table->string('mission_company_id');
            $table->boolean('is_remote')->default(false);
            $table->string('address');
            $table->string('estimated_budget');
            $table->boolean('is_urgent')->default(false);
            $table->string('deadline');
            $table->string('mission_privacy');
            $table->text('mission_description');
            $table->text('mission_objective');
            $table->text('mission_files');
            $table->boolean('files_share_with_public')->default(false);
            $table->boolean('enable_crowdfunding')->default(false);
            $table->string('min_raise_amount');
            $table->string('max_raise_amount');
            $table->boolean('allow_multiple_source_participate')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
