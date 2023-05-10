<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product');
            $table->integer('feature_id')->unsigned();
            $table->foreign('feature_id')->references('id')->on('features');
            $table->timestamps();


            Schema::create('producto_caracteristica', function (Blueprint $table) {
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('feature_id');
                $table->timestamps();

                $table->primary(['product_id', 'feature_id']);

                $table->foreign('product_id')
                    ->references('id')
                    ->on('product')
                    ->onDelete('cascade');
                $table->foreign('feature_id')
                    ->references('id')
                    ->on('features')
                    ->onDelete('cascade');
            });


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_features');
    }
};
