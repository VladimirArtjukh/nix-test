<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('image_tag')) {
            Schema::create('image_tag', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('image_id')->comment('Image ID');
                $table->unsignedBigInteger('tag_id')->comment('Tag ID');
                $table->timestamps();

                $table->foreign('image_id')
                    ->references('id')
                    ->on('images')
                    ->onDelete('cascade');

                $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_tag');
    }
}
