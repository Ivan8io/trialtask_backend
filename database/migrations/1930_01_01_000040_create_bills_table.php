<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Счета к оплате
        Schema::create('bills', function (Blueprint $table) {
            $table->id();                       // Номер выставленного счёта
            $table->foreignId('resident_id')->constrained();     // Ссылка на дачника
            $table->foreignId('period_id')->constrained();       // Ссылка на период
            $table->float('amount_rub');        // Сумма к оплате

            // Дачнику за период выставляется только один счёт
            $table->unique(['resident_id', 'period_id']);

            // Внешний ключ: нельзя удалять дачника
            // которому уже выставлен счёт
            // Внешний ключ: нельзя удалять период
            // по которому уже выставлен счёт
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
