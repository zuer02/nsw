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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_total', 8, 2);
            $table->tinyInteger('quantidade_total')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('produto_venda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id')->required();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->unsignedBigInteger('venda_id')->required();
            $table->foreign('venda_id')->references('id')->on('vendas');
            $table->tinyInteger('quantidade')->default(0)->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto_venda', function(BLueprint $table) {
            $table->dropForeign('produtos_produto_id_foreign');
            $table->dropColumn('produto_id');
            $table->dropForeign('vendas_venda_id_foreign');
            $table->dropColumn('venda_id');
        });
        Schema::dropIfExists('produto_venda');
        Schema::dropIfExists('vendas');
    }
};
