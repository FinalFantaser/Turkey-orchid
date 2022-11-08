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
            $table->unsignedMediumInteger('price_sale')->default(0);
            $table->unsignedMediumInteger('price_rent')->default(0);
            $table->unsignedMediumInteger('price_m2')->default(0);
            $table->unsignedMediumInteger('area')->default(0);
            $table->string('rooms')->default('0');
            $table->unsignedMediumInteger('bedrooms')->default(0);
            $table->unsignedMediumInteger('bathrooms')->default(0);
            $table->unsignedMediumInteger('floor')->default(0);
            $table->unsignedMediumInteger('total_floors')->default(0);
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
