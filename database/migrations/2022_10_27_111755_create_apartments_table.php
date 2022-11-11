<?php

use App\Models\Blog\Category;
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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Category::class)->cascadeOnDelete();
            $table->string('title');
            $table->string('seo_title')->default('');
            $table->text('description')->default('');
            $table->string('address')->default('');
            $table->string('located_at')->default('');
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('price_m2')->default(0);
            $table->unsignedBigInteger('area')->default(0);
            $table->unsignedBigInteger('rooms')->default(0);
            $table->unsignedBigInteger('bedrooms')->default(0);
            $table->unsignedBigInteger('bathrooms')->default(0);
            $table->unsignedBigInteger('floor')->default(0);
            $table->unsignedBigInteger('total_floors')->default(0);
            $table->json('details')->nullable();
            $table->json('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};
