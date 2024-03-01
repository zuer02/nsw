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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 40)->required();
            $table->string('foto')->required(); // caminho da foto na public
            $table->decimal('valor', 8, 2)->required();
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->tinyInteger('quantidade')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function(BLueprint $table) {
            $table->dropForeign('produtos_categoria_id_foreign');
            $table->dropColumn('categoria_id');
        });
        Schema::dropIfExists('produtos');
    }
};
